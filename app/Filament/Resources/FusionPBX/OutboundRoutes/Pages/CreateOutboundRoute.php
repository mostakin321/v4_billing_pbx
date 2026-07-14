<?php

namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Pages;

use App\Filament\Resources\FusionPBX\OutboundRoutes\OutboundRouteResource;
use App\Filament\Resources\FusionPBX\OutboundRoutes\Schemas\OutboundRouteWizardForm;
use App\Models\FusionPBX\Dialplan;
use App\Models\FusionPBX\DialplanDetail;
use App\Models\FusionPBX\Domain;
use App\Models\FusionPBX\Gateway;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Str;

class CreateOutboundRoute extends Page
{
    protected static string $resource = OutboundRouteResource::class;

    protected string $view = 'filament.pages.create-outbound-route';

    public array $data = [];

    const OUTBOUND_APP_UUID = '8c914ec3-9fc0-8ab5-4cda-6c9288bdc9a3';

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $form): Schema
    {
        return OutboundRouteWizardForm::configure(
            $form->statePath('data')
        );
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Outbound Route')
                ->icon('heroicon-o-check')
                ->color('primary')
                ->action('save'),
            Action::make('cancel')
                ->label('Cancel')
                ->icon('heroicon-o-x-mark')
                ->color('gray')
                ->url(OutboundRouteResource::getUrl('index')),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $gateway       = $data['gateway'] ?? '';
        $gateway_2     = $data['gateway_2'] ?? '';
        $gateway_3     = $data['gateway_3'] ?? '';
        $expressions   = $data['dialplan_expressions'] ?? [];
        $prefix_number = $data['prefix_number'] ?? '';
        $limit         = $data['limit'] ?? '';
        $accountcode   = $data['accountcode'] ?? '';
        $toll_allow    = $data['toll_allow'] ?? '';
        $pin_number    = $data['pin_number'] ?? '';
        $dialplan_order      = $data['dialplan_order'] ?? '300';
        $dialplan_enabled    = $data['dialplan_enabled'] ?? 'true';
        $dialplan_description = $data['dialplan_description'] ?? '';

        // Get domain context from first domain
        $domain = Domain::where('domain_enabled', true)->first();
        $domain_uuid    = $domain?->domain_uuid ?? '';
        $domain_context = $domain?->domain_name ?? 'default';

        $limit_enable = (!empty($limit)) ? 'true' : 'false';

        // ── Resolve gateway info ─────────────────────────────────────────
        [$gateway_type, $gateway_uuid, $gateway_name] = $this->resolveGateway($gateway);
        [$gateway_2_type, $gateway_2_id, $gateway_2_name] = $this->resolveGateway($gateway_2);
        [$gateway_3_type, $gateway_3_id, $gateway_3_name] = $this->resolveGateway($gateway_3);

        $created = 0;

        // ── Loop through each selected expression ────────────────────────
        foreach ($expressions as $expression) {
            [$label, $abbrv] = $this->getExpressionMeta($expression);

            // Get outbound prefix from expression (digits between ^ and first parenthesis)
            $tmp_prefix = preg_replace('/^\^(\d{1,})\(.*/', '$1', $expression);
            $outbound_prefix = ($tmp_prefix === $expression) ? '' : $tmp_prefix;

            // Build bridge strings
            $bridge_data   = $this->buildBridgeData($gateway_type,  $gateway_uuid,  $gateway_2_id, $gateway_name,  $prefix_number, $expression, $abbrv);
            $bridge_2_data = $this->buildBridgeData($gateway_2_type, $gateway_2_id, '', $gateway_2_name, $prefix_number, $expression, $abbrv);
            $bridge_3_data = $this->buildBridgeData($gateway_3_type, $gateway_3_id, '', $gateway_3_name, $prefix_number, $expression, $abbrv);

            // Dialplan name
            $dialplan_name = $this->buildDialplanName($gateway_type, $gateway_name, $gateway_uuid, $gateway_2_name, $abbrv);

            // ── 1. call_direction-outbound dialplan ──────────────────────
            $dp_direction_uuid = (string) Str::uuid();
            $dp_direction = Dialplan::create([
                'dialplan_uuid'        => $dp_direction_uuid,
                'domain_uuid'          => $domain_uuid,
                'app_uuid'             => self::OUTBOUND_APP_UUID,
                'dialplan_name'        => 'call_direction-outbound' . (empty($dialplan_description) && !empty($abbrv) ? '.' . $abbrv : ''),
                'dialplan_order'       => 22,
                'dialplan_continue'    => 'true',
                'dialplan_context'     => $domain_context,
                'dialplan_enabled'     => $dialplan_enabled,
                'dialplan_description' => $dialplan_description,
            ]);

            // Details for call_direction dialplan
            $this->createDetail($dp_direction_uuid, $domain_uuid, 1, 'condition', '${user_exists}', 'false', '0', true);
            $this->createDetail($dp_direction_uuid, $domain_uuid, 2, 'condition', '${call_direction}', '^$', '0', true);
            $this->createDetail($dp_direction_uuid, $domain_uuid, 3, 'condition', 'destination_number', $expression, '0', true);
            $this->createDetail($dp_direction_uuid, $domain_uuid, 4, 'action',    'export',             'call_direction=outbound', '0', true, true);

            // ── 2. Main outbound route dialplan ─────────────────────────
            $dp_uuid = (string) Str::uuid();
            Dialplan::create([
                'dialplan_uuid'        => $dp_uuid,
                'domain_uuid'          => $domain_uuid,
                'app_uuid'             => self::OUTBOUND_APP_UUID,
                'dialplan_name'        => $dialplan_name,
                'dialplan_order'       => $dialplan_order,
                'dialplan_continue'    => 'false',
                'dialplan_context'     => $domain_context,
                'dialplan_enabled'     => $dialplan_enabled,
                'dialplan_description' => $dialplan_description,
            ]);

            $y = 1;
            // condition: user_exists = false
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'condition', '${user_exists}', 'false', '0', true);

            // condition: toll_allow (optional)
            if (!empty($toll_allow)) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'condition', '${toll_allow}', $toll_allow, '0', true);
            }

            // condition: destination_number
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'condition', 'destination_number', $expression, '0', true);

            // action: set accountcode
            $acct_data = !empty($accountcode)
                ? 'sip_h_accountcode=' . $accountcode
                : 'sip_h_accountcode=${accountcode}';
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', $acct_data, '0', !empty($accountcode));

            // action: export call_direction=outbound
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'export', 'call_direction=outbound', '0', true, true);

            // action: unset call_timeout
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'unset', 'call_timeout', '0', true);

            if ($gateway_type !== 'transfer') {
                // set hangup_after_bridge
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'hangup_after_bridge=true', '0', true);

                // set effective_caller_id_name
                $cid_name_data = ($expression === '(^911$|^933$)')
                    ? 'effective_caller_id_name=${emergency_caller_id_name}'
                    : 'effective_caller_id_name=${outbound_caller_id_name}';
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', $cid_name_data, '0', true);

                // set effective_caller_id_number
                $cid_num_data = ($expression === '(^911$|^933$)')
                    ? 'effective_caller_id_number=${emergency_caller_id_number}'
                    : 'effective_caller_id_number=${outbound_caller_id_number}';
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', $cid_num_data, '0', true);

                // inherit_codec
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'inherit_codec=true', '0', true);
                // ignore_display_updates
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'ignore_display_updates=true', '0', true);
                // callee_id_number
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'callee_id_number=$1', '0', true);
                // continue_on_fail
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'continue_on_fail=1,2,3,6,18,21,27,28,31,34,38,41,42,44,58,88,111,403,501,602,607,809', '0', true);
            }

            // enum action
            if (in_array($gateway_type, ['enum']) || in_array($gateway_2_type, ['enum'])) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'enum', $prefix_number . '$1 e164.org', '0', true);
            }

            // limit actions
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set',   'limit_max=' . $limit, '0', $limit_enable === 'true');
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'limit', 'hash ${domain_name} outbound ${limit_max} !USER_BUSY', '0', $limit_enable === 'true');

            // outbound_prefix set
            if (!empty($outbound_prefix)) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'outbound_prefix=' . $outbound_prefix, '0', true);
            }

            // pin_number
            $pin_enabled = is_numeric($pin_number) && $pin_number !== '';
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'pin_number=' . $pin_number, '0', $pin_enabled);
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'lua', 'pin_number.lua', '0', $pin_enabled);

            // provider_prefix (if prefix > 2 chars)
            if (strlen($prefix_number) > 2) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'set', 'provider_prefix=' . $prefix_number, '0', true);
            }

            // bridge primary
            $bridge_type = ($gateway_type === 'transfer') ? 'transfer' : 'bridge';
            $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', $bridge_type, $bridge_data, '0', true);

            // bridge alt 1
            if (!empty($bridge_2_data)) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'bridge', $bridge_2_data, '0', true);
            }
            // bridge alt 2
            if (!empty($bridge_3_data)) {
                $this->createDetail($dp_uuid, $domain_uuid, $y++, 'action', 'bridge', $bridge_3_data, '0', true);
            }

            $created++;
        }

        Notification::make()
            ->title("Outbound route created")
            ->body("Generated {$created} dialplan expression" . ($created > 1 ? 's' : '') . " with full FreeSWITCH action sets.")
            ->success()
            ->send();

        $this->redirect(OutboundRouteResource::getUrl('index'));
    }

    // ── Helpers ────────────────────────────────────────────────────────────

    private function resolveGateway(string $value): array
    {
        if (empty($value)) return ['gateway', '', ''];

        foreach (['bridge', 'enum', 'freetdm', 'transfer', 'xmpp', 'hangup'] as $type) {
            if (str_starts_with(strtolower($value), $type)) {
                $data = str_contains($value, ':') ? explode(':', $value, 2)[1] : '';
                return [$type, $data, ''];
            }
        }

        // Real gateway: "uuid:name"
        if (str_contains($value, ':')) {
            [$uuid, $name] = explode(':', $value, 2);
            return ['gateway', $uuid, $name];
        }

        return ['gateway', $value, $value];
    }

    private function buildBridgeData(string $type, string $id, string $id2, string $name, string $prefix, string $expression, string $abbrv): string
    {
        if (empty($id) && empty($name)) return '';

        return match(true) {
            $type === 'gateway' => $abbrv === '988'
                ? 'sofia/gateway/' . $id . '/' . $prefix . '18002738255'
                : 'sofia/gateway/' . $id . '/' . $prefix . '$1',
            $type === 'freetdm' => $id . '/1/a/' . $prefix . '$1',
            $type === 'xmpp'    => 'dingaling/gtalk/+' . $prefix . '$1@voice.google.com',
            $type === 'bridge'  => $id,
            $type === 'enum'    => '${enum_auto_route}',
            $type === 'transfer'=> $id,
            default             => '',
        };
    }

    private function buildDialplanName(string $type, string $name, string $uuid, string $alt_name, string $abbrv): string
    {
        return match($type) {
            'gateway'  => $name . '.' . $abbrv,
            'freetdm'  => 'freetdm.' . $abbrv,
            'xmpp'     => 'xmpp.' . $abbrv,
            'bridge'   => 'bridge.' . $abbrv,
            'transfer' => 'transfer.' . $abbrv,
            'enum'     => empty($alt_name) ? 'enum.' . $abbrv : $alt_name . '.' . $abbrv,
            default    => $name . '.' . $abbrv,
        };
    }

    private function getExpressionMeta(string $expr): array
    {
        $map = [
            '^(\d{7})$'    => ['7 Digits', '7d'],
            '^(\d{8})$'    => ['8 Digits', '8d'],
            '^(\d{9})$'    => ['9 Digits', '9d'],
            '^(\d{10})$'   => ['10 Digits', '10d'],
            '^\+?(\d{11})$' => ['11 Digits', '11d'],
            '^(?:\+1|1)?([2-9]\d{2}[2-9]\d{2}\d{4})$' => ['North America', '10-11-NANP'],
            '^(011\d{9,17})$' => ['North America Intl', '011.9-17d'],
            '^(00\d{9,17})$'  => ['Europe Intl', '00.9-17d'],
            '^(\d{12,20})$'   => ['International', 'intl'],
            '^(311)$'         => ['311', '311'],
            '^(411)$'         => ['411', '411'],
            '^(711)$'         => ['711', '711'],
            '(^911$|^933$)'   => ['911 Emergency', '911'],
            '(^988$)'         => ['988', '988'],
            '^(?:\+1|1)?(8(00|33|44|55|66|77|88)[2-9]\d{6})$' => ['Toll-Free', '800'],
            '^0118835100\d{8}$' => ['iNum', 'inum'],
        ];

        if (isset($map[$expr])) {
            return $map[$expr];
        }

        // Digit patterns 2-6
        foreach (range(2, 6) as $n) {
            if ($expr === "^(\\d{{$n}})\$") return ["{$n} Digits", "{$n}d"];
        }

        // Dial-9 patterns
        foreach (range(2, 11) as $n) {
            if ($expr === "^9(\\d{{$n}})\$") return ["Dial 9, then {$n} Digits", "9.{$n}d"];
        }

        $safe = preg_replace('/[^a-zA-Z0-9_\-]/', '', $expr);
        return [$expr, substr($safe, 0, 20)];
    }

    private function createDetail(
        string $dialplan_uuid,
        string $domain_uuid,
        int $order,
        string $tag,
        string $type,
        string $data,
        string $group = '0',
        bool|string $enabled = true,
        bool $inline = false
    ): void {
        $row = [
            'dialplan_detail_uuid'    => (string) Str::uuid(),
            'domain_uuid'             => $domain_uuid,
            'dialplan_uuid'           => $dialplan_uuid,
            'dialplan_detail_tag'     => $tag,
            'dialplan_detail_type'    => $type,
            'dialplan_detail_data'    => $data,
            'dialplan_detail_order'   => $order * 10,
            'dialplan_detail_group'   => $group,
            'dialplan_detail_enabled' => is_bool($enabled) ? ($enabled ? 'true' : 'false') : $enabled,
        ];

        if ($inline) {
            $row['dialplan_detail_inline'] = 'true';
        }

        DialplanDetail::create($row);
    }
}
