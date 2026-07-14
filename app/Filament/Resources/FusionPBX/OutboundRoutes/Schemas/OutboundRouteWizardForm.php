<?php

namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Schemas;

use App\Models\FusionPBX\Gateway;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class OutboundRouteWizardForm
{
    public static function expressions(): array
    {
        return [
            '^(\d{2})$'    => '2 Digits',
            '^(\d{3})$'    => '3 Digits',
            '^(\d{4})$'    => '4 Digits',
            '^(\d{5})$'    => '5 Digits',
            '^(\d{6})$'    => '6 Digits',
            '^(\d{7})$'    => '7 Digits',
            '^(\d{8})$'    => '8 Digits',
            '^(\d{9})$'    => '9 Digits',
            '^(\d{10})$'   => '10 Digits',
            '^\+?(\d{11})$' => '11 Digits Long Distance',
            '^(?:\+1|1)?([2-9]\d{2}[2-9]\d{2}\d{4})$' => 'North America',
            '^(011\d{9,17})$' => 'North America International',
            '^(?:\+1|1)?((?:264|268|242|246|441|284|345|767|809|829|849|473|658|876|664|787|939|869|758|784|721|868|649|340|684|671|670|808)\d{7})$' => 'North America Islands',
            '^(00\d{9,17})$' => 'Europe International',
            '^(\d{12,20})$' => 'International',
            '^(311)$' => '311 Information',
            '^(411)$' => '411 Information',
            '^(711)$' => '711 TTY',
            '(^911$|^933$)' => '911 Emergency',
            '(^988$)' => '988 National Suicide Prevention Lifeline',
            '^(?:\+1|1)?(8(00|33|44|55|66|77|88)[2-9]\d{6})$' => 'Toll-Free',
            '^0118835100\d{8}$' => 'iNum 0118835100xxxxxxxx',
            '^9(\d{2})$'  => 'Dial 9, then 2 Digits',
            '^9(\d{3})$'  => 'Dial 9, then 3 Digits',
            '^9(\d{4})$'  => 'Dial 9, then 4 Digits',
            '^9(\d{5})$'  => 'Dial 9, then 5 Digits',
            '^9(\d{6})$'  => 'Dial 9, then 6 Digits',
            '^9(\d{7})$'  => 'Dial 9, then 7 Digits',
            '^9(\d{8})$'  => 'Dial 9, then 8 Digits',
            '^9(\d{9})$'  => 'Dial 9, then 9 Digits',
            '^9(\d{10})$' => 'Dial 9, then 10 Digits',
            '^9(\d{11})$' => 'Dial 9, then 11 Digits',
        ];
    }

    /**
     * Build gateway options using ->options() grouped format (no null values).
     * Filament Select supports ['Group Label' => ['key' => 'label']] for optgroups.
     */
    public static function gatewayOptionsGrouped(): array
    {
        $gateways = Gateway::where('enabled', 'true')
            ->orderBy('gateway')
            ->get()
            ->mapWithKeys(fn($g) => [
                $g->gateway_uuid . ':' . $g->gateway => $g->gateway
            ])
            ->toArray();

        return [
            'SIP Gateways' => $gateways ?: ['(none)' => 'No gateways found'],
            'Additional Options' => [
                'enum'     => 'enum',
                'freetdm'  => 'freetdm',
                'transfer:$1 XML ${domain_name}' => 'transfer',
                'xmpp'     => 'xmpp',
                'hangup'   => 'hangup',
            ],
        ];
    }

    public static function configure(Schema $form): Schema
    {
        $groupedOptions = self::gatewayOptionsGrouped();

        return $form->schema([

            Section::make('Gateway Selection')
                ->description('Select the primary gateway and up to two failover gateways.')
                ->icon('heroicon-o-globe-alt')
                ->columns(1)
                ->schema([
                    Select::make('gateway')
                        ->label('Primary Gateway')
                        ->options($groupedOptions)
                        ->searchable()
                        ->required()
                        ->helperText('The SIP gateway to bridge calls through.'),

                    Select::make('gateway_2')
                        ->label('Alternate 1 — Failover')
                        ->options($groupedOptions)
                        ->searchable()
                        ->placeholder('— Optional —')
                        ->helperText('FreeSWITCH tries this if the primary fails.'),

                    Select::make('gateway_3')
                        ->label('Alternate 2 — Failover')
                        ->options($groupedOptions)
                        ->searchable()
                        ->placeholder('— Optional —')
                        ->helperText('Tried if Alternate 1 also fails.'),
                ]),

            Section::make('Dialplan Expressions')
                ->description('Check the number patterns this route should match. Each creates a separate dialplan entry automatically.')
                ->icon('heroicon-o-code-bracket-square')
                ->schema([
                    CheckboxList::make('dialplan_expressions')
                        ->label('Number Patterns')
                        ->options(self::expressions())
                        ->columns(3)
                        ->bulkToggleable()
                        ->required()
                        ->helperText('Select all patterns to route through this gateway. "North America" covers standard 10/11-digit US & Canada calls.'),
                ]),

            Section::make('Route Options')
                ->description('These settings apply to all patterns selected above.')
                ->icon('heroicon-o-adjustments-horizontal')
                ->columns(3)
                ->schema([
                    TextInput::make('prefix_number')
                        ->label('Prefix Number')
                        ->placeholder('e.g. 1 or 011')
                        ->helperText('Prepended to dialed number before sending to gateway.'),

                    TextInput::make('limit')
                        ->label('Concurrent Call Limit')
                        ->numeric()
                        ->placeholder('e.g. 10')
                        ->helperText('Empty = unlimited.'),

                    TextInput::make('accountcode')
                        ->label('Account Code')
                        ->placeholder('e.g. billing-001'),

                    TextInput::make('toll_allow')
                        ->label('Toll Allow')
                        ->placeholder('domestic,international')
                        ->helperText('Extensions must have matching toll_allow.'),

                    TextInput::make('pin_number')
                        ->label('PIN Number')
                        ->numeric()
                        ->placeholder('Optional security PIN'),

                    Select::make('dialplan_order')
                        ->label('Priority (Order)')
                        ->options(collect(range(100, 300, 10))
                            ->mapWithKeys(fn($n) => [(string)$n => str_pad($n, 3, '0', STR_PAD_LEFT)])
                            ->toArray())
                        ->default('300')
                        ->native(false)
                        ->helperText('Lower = evaluated first.'),
                ]),

            Section::make('Status & Description')
                ->columns(2)
                ->schema([
                    Select::make('dialplan_enabled')
                        ->label('Status')
                        ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                        ->default('true')
                        ->native(false),

                    TextInput::make('dialplan_description')
                        ->label('Description')
                        ->placeholder('Optional notes...'),
                ]),

            Section::make('How This Works')
                ->icon('heroicon-o-information-circle')
                ->collapsed()
                ->schema([
                    Placeholder::make('how_it_works')
                        ->label('')
                        ->content(new HtmlString('
                            <p style="font-size:0.82rem;color:#6b7280;line-height:1.7;margin:0">
                                <strong>Saving creates two dialplan entries per expression selected:</strong><br>
                                &nbsp;1. <code style="background:#f3f4f6;padding:1px 4px;border-radius:3px">call_direction-outbound.{pattern}</code>
                                    — marks the call as outbound via <em>export</em><br>
                                &nbsp;2. <code style="background:#f3f4f6;padding:1px 4px;border-radius:3px">{gateway}.{pattern}</code>
                                    — bridges to <code>sofia/gateway/{uuid}/$1</code><br><br>
                                Failover gateways add additional <em>bridge</em> actions tried in sequence.
                            </p>
                        ')),
                ]),
        ]);
    }
}
