<?php

namespace App\Services\Cgrates;

use App\Models\Billing\Rate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * RateCgratesSyncService
 *
 * Pushes a single Rate (kb_rates row) into CGRateS as a real, live
 * Destination + Rate + DestinationRate + RatingPlan + RatingProfile,
 * using ONLY the RPC method names we confirmed actually exist and
 * work on this CGRateS install (see the voice billing session notes —
 * APIerSv1.LoadTariffPlanFromStorDb, APIerSv1.ReloadConfig, and
 * APIerSv2.SetAccount do NOT exist and must never be used again).
 *
 * Naming convention inside CGRateS, derived from the Rate's own data
 * so it's traceable back to the admin screen:
 *   Destination ID    : "DST_" + prefix                     e.g. DST_1
 *   Rate ID            : "RT_"  + rate uuid (first 8 chars)   e.g. RT_a1b2c3d4
 *   DestinationRate ID : "DR_"  + same                        e.g. DR_a1b2c3d4
 *   RatingPlan ID       : one per ratecard -> "RP_" + ratecard uuid (first 8)
 *   RatingProfile       : Tenant=cgrates.org, Category=call,
 *                          Subject = ratecard type ('buy' or 'sell')
 *
 * IMPORTANT: "buy" ratecards and "sell" ratecards get separate
 * RatingProfiles (Subject="buy" / Subject="sell") so the same prefix
 * can have two different costs at once — what you pay the supplier
 * (buy) vs what you charge the customer (sell). When actually rating
 * a real call you choose which one to query by passing the right
 * Subject — the Go worker will pass Subject="sell" when billing a
 * customer, and Laravel can separately query Subject="buy" for
 * margin/profit reporting on the same call.
 */
class RateCgratesSyncService
{
    private string $endpoint;
    private string $tenant;
    private int $timeout;

    public function __construct()
    {
        $this->endpoint = config('cgrates.url', env('CGRATES_URL', 'http://127.0.0.1:2080/jsonrpc'));
        $this->tenant   = config('cgrates.tenant', env('CGRATES_TENANT', 'cgrates.org'));
        $this->timeout  = (int) env('CGRATES_TIMEOUT', 10);
    }

    // ──────────────────────────────────────────────────────────
    //  Public API
    // ──────────────────────────────────────────────────────────

    public function syncRate(Rate $rate): void
    {
        $rate->loadMissing('ratecard');
        $ratecard = $rate->ratecard;
        if (!$ratecard) {
            throw new RuntimeException("Rate {$rate->uuid} has no ratecard — skipping CGRateS sync");
        }

        $destId   = $this->destinationId($rate->prefix);
        $rateId   = $this->rateId($rate->uuid);
        $drId     = $this->destinationRateId($rate->uuid);
        $rpId     = $this->ratingPlanId($ratecard->uuid);
        $subject  = $ratecard->type; // 'buy' or 'sell' (or 'reseller', treated as sell-equivalent)

        // 1. Destination — which prefix this rate applies to
        $this->call('ApierV2.SetTPDestination', [[
            'TPid'     => $this->tenant,
            'ID'       => $destId,
            'Prefixes' => [$rate->prefix],
        ]]);

        // 2. Rate — the actual price (per-minute, with connect fee + grace period)
        $this->call('ApierV1.SetTPRate', [[
            'TPid' => $this->tenant,
            'ID'   => $rateId,
            'RateSlots' => [[
                'ConnectFee'         => (float) $rate->connection_charge,
                'Rate'               => (float) $rate->rate_per_minute,
                'RateUnit'           => '60s',
                'RateIncrement'      => "{$rate->billing_block}s",
                'GroupIntervalStart' => "{$rate->grace_period}s",
            ]],
        ]]);

        // 3. DestinationRate — link the Destination to the Rate
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

        // 4. RatingPlan — one per ratecard, accumulates all its DestinationRates.
        //    We re-fetch all active rates under this ratecard so the plan stays
        //    complete even though we're only touching one Rate right now.
        $this->rebuildRatingPlanForRatecard($ratecard);

        // 5. RatingProfile — link Subject (buy/sell) -> RatingPlan
        $this->call('APIerSv1.SetRatingProfile', [[
            'TPid'     => $this->tenant,
            'Overwrite'=> true,
            'LoadId'   => 'laravel-rate-sync',
            'Tenant'   => $this->tenant,
            'Category' => 'call',
            'Subject'  => $subject,
            'RatingPlanActivations' => [[
                'ActivationTime'   => '2014-01-14T00:00:00Z',
                'RatingPlanId'     => $rpId,
                'FallbackSubjects' => '',
            ]],
        ]]);

        // 6. ChargerS DEFAULT profile must exist or every CDR will come back
        //    PARTIALLY_EXECUTED (confirmed gotcha from the voice billing phase).
        $this->ensureDefaultCharger();

        Log::info("[RateCgratesSync] Synced rate {$rate->uuid} (prefix={$rate->prefix}, type={$subject}) into CGRateS");
    }

    public function removeRate(Rate $rate): void
    {
        // CGRateS doesn't have a clean "delete a single rate" RPC in the
        // confirmed-working set, so the safe approach is: rebuild the
        // RatingPlan for this rate's ratecard, excluding the now-deleted
        // rate (it's already gone from the DB by the time this runs).
        $rate->loadMissing('ratecard');
        if ($rate->ratecard) {
            $this->rebuildRatingPlanForRatecard($rate->ratecard);
        }
    }

    /**
     * Get the real cost for a destination, for either the 'buy' or
     * 'sell' side. This is what the Go worker / Laravel call when a
     * real call needs rating.
     */
    public function getCost(string $subjectType, string $account, string $destination, int $usageSeconds): float
    {
        $result = $this->call('ApierV2.GetCost', [[
            'Tenant'      => $this->tenant,
            'Category'    => 'call',
            'ToR'         => '*voice',
            'Subject'     => $subjectType, // 'buy' or 'sell'
            'Account'     => $account,
            'Destination' => $destination,
            'AnswerTime'  => now()->toIso8601String(),
            'Usage'       => "{$usageSeconds}s",
        ]]);

        return (float) ($result['Cost'] ?? 0.0);
    }

    // ──────────────────────────────────────────────────────────
    //  Internal helpers
    // ──────────────────────────────────────────────────────────

    private function rebuildRatingPlanForRatecard(\App\Models\Billing\Ratecard $ratecard): void
    {
        $rpId = $this->ratingPlanId($ratecard->uuid);

        $bindings = $ratecard->rates()
            ->where('status', 'active')
            ->get()
            ->map(fn (Rate $r) => [
                'DestinationRatesId' => $this->destinationRateId($r->uuid),
                'TimingId'           => '*any',
                'Weight'             => 10,
            ])
            ->values()
            ->all();

        if (empty($bindings)) {
            // Nothing active left under this ratecard — nothing to bind.
            return;
        }

        $this->call('APIerSv1.SetTPRatingPlan', [[
            'TPid' => $this->tenant,
            'ID'   => $rpId,
            'RatingPlanBindings' => $bindings,
        ]]);

        // Push this RatingPlan from StorDB into CGRateS's live engine.
        // Confirmed-working method (NOT the plural/typo'd variants):
        $this->call('ApierV2.LoadRatingPlan', [[
            'TPid' => $this->tenant,
            'ID'   => $rpId,
        ]]);
    }

    private function ensureDefaultCharger(): void
    {
        static $alreadyChecked = false;
        if ($alreadyChecked) return;

        // Both variants — confirmed in the voice billing phase that
        // both APIerSv1 and ApierV2 forms were needed for this to take
        // effect reliably across restarts.
        $this->call('APIerSv1.SetChargerProfile', [[
            'Tenant'       => $this->tenant,
            'ID'           => 'DEFAULT',
            'FilterIDs'    => [],
            'AttributeIDs' => ['*none'],
            'RunID'        => '*default',
            'Weight'       => 0,
        ]]);
        $this->call('ApierV2.SetChargerProfile', [[
            'Tenant'       => $this->tenant,
            'ID'           => 'DEFAULT',
            'FilterIDs'    => [],
            'AttributeIDs' => ['*none'],
            'RunID'        => '*default',
            'Weight'       => 0,
        ]]);

        $alreadyChecked = true;
    }

    private function destinationId(string $prefix): string
    {
        return 'DST_' . preg_replace('/[^0-9]/', '', $prefix);
    }

    private function rateId(string $uuid): string
    {
        return 'RT_' . substr(str_replace('-', '', $uuid), 0, 12);
    }

    private function destinationRateId(string $uuid): string
    {
        return 'DR_' . substr(str_replace('-', '', $uuid), 0, 12);
    }

    private function ratingPlanId(string $ratecardUuid): string
    {
        return 'RP_' . substr(str_replace('-', '', $ratecardUuid), 0, 12);
    }

    /**
     * @throws RuntimeException on transport failure or CGRateS-reported error
     */
    private function call(string $method, array $params): mixed
    {
        $response = Http::timeout($this->timeout)
            ->post($this->endpoint, [
                'id'     => Str::random(8),
                'method' => $method,
                'params' => $params,
            ]);

        if ($response->failed()) {
            throw new RuntimeException("CGRateS HTTP error [{$method}]: {$response->status()}");
        }

        $data = $response->json();

        if (!empty($data['error'])) {
            throw new RuntimeException("CGRateS RPC error [{$method}]: " . (is_string($data['error']) ? $data['error'] : json_encode($data['error'])));
        }

        return $data['result'] ?? null;
    }
}
