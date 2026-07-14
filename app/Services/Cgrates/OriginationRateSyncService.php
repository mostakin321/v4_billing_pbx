<?php

namespace App\Services\Cgrates;

use App\Models\Billing\Pricelist;
use App\Models\Billing\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * OriginationRateSyncService
 *
 * Pushes a Billing\Route (the real ASTPP `rates` table, edited via
 * the "Origination Rates" screen) into CGRateS as a real Destination
 * + Rate + DestinationRate + RatingPlan + RatingProfile — same proven
 * mechanism as RateCgratesSyncService (kb_rates), retargeted at the
 * real `rates`/`pricelists` tables instead of `kb_rates`/`kb_ratecards`.
 *
 * KEY FIX: the old CGRatesService::syncAccount() hardcoded a single
 * RatingPlanId of 'RatingPlan_Kazitel' for every account. That plan
 * vanished (confirmed: missing from both live CGRateS and StorDB),
 * which made syncAccount() fail every single run, every 5 minutes,
 * for every account, since whenever this server's scheduler runs it.
 *
 * This service instead generates ONE RatingPlan PER Pricelist (Rate
 * Group), named deterministically from the pricelist's own ID:
 *   RatingPlan_PL<pricelist_id>
 * So "default" (pricelist_id=1) becomes RatingPlan_PL1. Every Route
 * (rate) under that pricelist gets bound into that one plan. This is
 * self-healing: if the plan ever goes missing again, the very next
 * time ANY rate under that pricelist is saved, it gets recreated —
 * no more silent, permanent failure.
 */
class OriginationRateSyncService
{
    private string $endpoint;
    private string $tenant;

    public function __construct()
    {
        $this->endpoint = config('cgrates.url', env('CGRATES_URL', 'http://127.0.0.1:2080/jsonrpc'));
        $this->tenant   = config('cgrates.tenant', env('CGRATES_TENANT', 'cgrates.org'));
    }

    public function sync(Route $route): void
    {
        $route->loadMissing('pricelist');
        $pricelist = $route->pricelist;
        if (!$pricelist) {
            throw new RuntimeException("Route #{$route->id} has no pricelist — skipping CGRateS sync");
        }

        if ((int) $route->status !== 0) {
            // status 0 = active (confirmed convention used everywhere
            // else in this app). Inactive rates don't get pushed live.
            return;
        }

        $destId  = 'DST_' . preg_replace('/[^0-9]/', '', $route->prefix);
        $rateId  = 'RT_PL' . $pricelist->id . '_' . $route->id;
        $drId    = 'DR_PL' . $pricelist->id . '_' . $route->id;
        $rpId    = $this->ratingPlanId($pricelist);
        $subject = "pricelist_{$pricelist->id}"; // RatingProfile Subject — distinct per rate group

        // 1. Destination
        $this->call('ApierV2.SetTPDestination', [[
            'TPid'     => $this->tenant,
            'ID'       => $destId,
            'Prefixes' => [$route->prefix],
        ]]);

        // 2. Rate — real ASTPP fields map directly:
        //    rate = per-minute price, connectcost = connect fee,
        //    init_inc/initblock = first billing block, inc = increment
        $this->call('ApierV1.SetTPRate', [[
            'TPid' => $this->tenant,
            'ID'   => $rateId,
            'RateSlots' => [[
                'ConnectFee'         => (float) $route->connectcost,
                'Rate'               => (float) $route->rate,
                'RateUnit'           => '60s',
                'RateIncrement'      => "{$route->increment}s",
                'GroupIntervalStart' => '0s',
            ]],
        ]]);

        // 3. DestinationRate
        $this->call('ApierV1.SetTPDestinationRate', [[
            'ID'   => $drId,
            'TPid' => $this->tenant,
            'DestinationRates' => [[
                'DestinationId'    => $destId,
                'RateId'           => $rateId,
                'Rate'             => null,
                'RoundingMethod'   => '*up',
                'RoundingDecimals' => 4,
                'MaxCost'          => 0,
                'MaxCostStrategy'  => '',
            ]],
        ]]);

        // 4. RatingPlan — rebuild the WHOLE plan for this pricelist
        //    (not just this one rate), so the plan always reflects
        //    every active rate currently under this rate group.
        $this->rebuildRatingPlanForPricelist($pricelist);

        // 5. RatingProfile — one per pricelist, Subject = pricelist_<id>
        $this->call('APIerSv1.SetRatingProfile', [[
            'TPid'      => $this->tenant,
            'Overwrite' => true,
            'LoadId'    => 'laravel-origination-sync',
            'Tenant'    => $this->tenant,
            'Category'  => 'call',
            'Subject'   => $subject,
            'RatingPlanActivations' => [[
                'ActivationTime'   => '2014-01-14T00:00:00Z',
                'RatingPlanId'     => $rpId,
                'FallbackSubjects' => '',
            ]],
        ]]);

        $this->ensureDefaultCharger();

        Log::info("[OriginationRateSync] Synced route #{$route->id} (prefix={$route->prefix}, pricelist={$pricelist->id}) into CGRateS as {$rpId}");
    }

    /**
     * Self-healing rebuild: call this any time you need to GUARANTEE
     * a pricelist's RatingPlan exists and is current — e.g. from a
     * scheduled command, or manually via Filament action.
     */
    public function rebuildRatingPlanForPricelist(Pricelist $pricelist): void
    {
        $rpId = $this->ratingPlanId($pricelist);

        $bindings = Route::where('pricelist_id', $pricelist->id)
            ->where('status', 0)
            ->get()
            ->map(fn (Route $r) => [
                'DestinationRatesId' => 'DR_PL' . $pricelist->id . '_' . $r->id,
                'TimingId'           => '*any',
                'Weight'             => 10,
            ])
            ->values()
            ->all();

        if (empty($bindings)) {
            Log::info("[OriginationRateSync] Pricelist {$pricelist->id} has no active rates — nothing to bind into {$rpId}");
            return;
        }

        $this->call('APIerSv1.SetTPRatingPlan', [[
            'TPid' => $this->tenant,
            'ID'   => $rpId,
            'RatingPlanBindings' => $bindings,
        ]]);

        $this->call('ApierV2.LoadRatingPlan', [[
            'TPid' => $this->tenant,
            'ID'   => $rpId,
        ]]);
    }

    private function ratingPlanId(Pricelist $pricelist): string
    {
        return 'RatingPlan_PL' . $pricelist->id;
    }

    private function ensureDefaultCharger(): void
    {
        static $checked = false;
        if ($checked) return;

        $this->call('APIerSv1.SetChargerProfile', [[
            'Tenant' => $this->tenant, 'ID' => 'DEFAULT',
            'FilterIDs' => [], 'AttributeIDs' => ['*none'], 'RunID' => '*default', 'Weight' => 0,
        ]]);
        $this->call('ApierV2.SetChargerProfile', [[
            'Tenant' => $this->tenant, 'ID' => 'DEFAULT',
            'FilterIDs' => [], 'AttributeIDs' => ['*none'], 'RunID' => '*default', 'Weight' => 0,
        ]]);

        $checked = true;
    }

    private function call(string $method, array $params): mixed
    {
        $response = Http::timeout(10)->post($this->endpoint, [
            'id'     => uniqid(),
            'method' => $method,
            'params' => $params,
        ]);

        $data = $response->json();
        if (!empty($data['error'])) {
            throw new RuntimeException("CGRateS [{$method}]: " . (is_string($data['error']) ? $data['error'] : json_encode($data['error'])));
        }
        return $data['result'] ?? null;
    }
}
