<?php

namespace App\Filament\Resources\FusionPBX\RingGroups\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class RingGroupForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Ring Group')
                ->columnSpanFull()
                ->tabs([

                    // ── TAB 1: MAIN ──────────────────────────────────────
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-user-group')
                        ->schema([

                            Section::make('Ring Group Identity')
                                ->columns(3)
                                ->schema([
                                    TextInput::make('ring_group_name')
                                        ->label('Name')
                                        ->required()
                                        ->placeholder('e.g. Sales Team')
                                        ->columnSpan(2),

                                    Select::make('ring_group_enabled')
                                        ->label('Status')
                                        ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                        ->default('true')
                                        ->native(false),

                                    TextInput::make('ring_group_extension')
                                        ->label('Extension')
                                        ->placeholder('e.g. 6000')
                                        ->helperText('Callers dial this to reach the ring group.'),

                                    Select::make('ring_group_strategy')
                                        ->label('Ring Strategy')
                                        ->options([
                                            'enterprise'    => 'Enterprise — ring all simultaneously',
                                            'sequence'      => 'Sequence — ring in order',
                                            'simultaneous'  => 'Simultaneous — ring all at once',
                                            'random'        => 'Random — pick random destination',
                                            'rollover'      => 'Rollover — try next if busy',
                                        ])
                                        ->default('enterprise')
                                        ->native(false)
                                        ->required()
                                        ->helperText('Controls how destinations are tried.'),

                                    TextInput::make('ring_group_call_timeout')
                                        ->label('Ring Timeout (sec)')
                                        ->numeric()
                                        ->default(30)
                                        ->placeholder('30')
                                        ->helperText('Seconds before trying next or timeout action.'),

                                    Textarea::make('ring_group_description')
                                        ->label('Description')
                                        ->rows(2)
                                        ->columnSpanFull(),
                                ]),

                            // ── DESTINATIONS REPEATER ────────────────────
                            Section::make('Destinations')
                                ->description('Numbers to ring. Use extension numbers, external numbers, or SIP URIs.')
                                ->icon('heroicon-o-phone')
                                ->schema([
                                    Repeater::make('ringGroupDestinations')
                                        ->label('')
                                        ->relationship('destinations')
                                        ->schema([
                                            TextInput::make('destination_number')
                                                ->label('Number')
                                                ->placeholder('e.g. 1001 or +1234567890')
                                                ->required()
                                                ->columnSpan(2),

                                            TextInput::make('destination_delay')
                                                ->label('Delay (sec)')
                                                ->numeric()
                                                ->default(0)
                                                ->placeholder('0')
                                                ->helperText('Seconds before ringing (sequence/rollover: order number).'),

                                            TextInput::make('destination_timeout')
                                                ->label('Timeout (sec)')
                                                ->numeric()
                                                ->default(30)
                                                ->placeholder('30'),

                                            Select::make('destination_prompt')
                                                ->label('Call Screen')
                                                ->options([
                                                    ''  => 'No prompt',
                                                    '1' => 'Confirm answer',
                                                ])
                                                ->default('')
                                                ->native(false)
                                                ->helperText('Ask callee to press 1 to accept.'),

                                            TextInput::make('destination_description')
                                                ->label('Description')
                                                ->placeholder('e.g. Alice mobile')
                                                ->columnSpan(2),

                                            Select::make('destination_enabled')
                                                ->label('Enabled')
                                                ->options(['true' => 'Yes', 'false' => 'No'])
                                                ->default('true')
                                                ->native(false),
                                        ])
                                        ->columns(8)
                                        ->defaultItems(3)
                                        ->addActionLabel('Add Destination')
                                        ->reorderable()
                                        ->reorderableWithButtons()
                                        ->collapsible()
                                        ->itemLabel(fn(array $state): ?string =>
                                            isset($state['destination_number']) && $state['destination_number']
                                                ? ($state['destination_description']
                                                    ? $state['destination_description'] . ' — ' . $state['destination_number']
                                                    : $state['destination_number'])
                                                : null
                                        ),
                                ]),
                        ]),

                    // ── TAB 2: TIMEOUT ACTION ────────────────────────────
                    Tabs\Tab::make('Timeout Action')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            Section::make('No Answer Routing')
                                ->description('What to do when nobody answers within the ring timeout.')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ring_group_timeout_app')
                                        ->label('Timeout Application')
                                        ->placeholder('transfer')
                                        ->helperText('FreeSWITCH app: transfer, voicemail, hangup...'),

                                    TextInput::make('ring_group_timeout_data')
                                        ->label('Timeout Data')
                                        ->placeholder('*99 XML default')
                                        ->helperText('e.g. 1001 XML default (for voicemail: *99 XML default)'),

                                    TextInput::make('ring_group_exit_key')
                                        ->label('Exit Key')
                                        ->placeholder('*')
                                        ->helperText('Key caller presses to exit to timeout action immediately.'),
                                ]),

                            Section::make('Forward Settings')
                                ->columns(2)
                                ->schema([
                                    Select::make('ring_group_call_forward_enabled')
                                        ->label('Call Forward Enabled')
                                        ->options(['true' => 'Yes', 'false' => 'No'])
                                        ->default('false')
                                        ->native(false),

                                    TextInput::make('ring_group_forward_destination')
                                        ->label('Forward Destination')
                                        ->placeholder('+1234567890 or extension')
                                        ->helperText('Override destination when call forward is enabled.'),

                                    TextInput::make('ring_group_forward_toll_allow')
                                        ->label('Forward Toll Allow')
                                        ->placeholder('domestic,international'),

                                    Select::make('ring_group_follow_me_enabled')
                                        ->label('Follow Me Enabled')
                                        ->options(['true' => 'Yes', 'false' => 'No'])
                                        ->default('false')
                                        ->native(false),
                                ]),
                        ]),

                    // ── TAB 3: CALLER ID ─────────────────────────────────
                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID Override')
                                ->description('Override the caller ID presented to ring group members.')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ring_group_caller_id_name')
                                        ->label('Caller ID Name')
                                        ->placeholder('e.g. Office')
                                        ->helperText('Override caller name shown to agents.'),

                                    TextInput::make('ring_group_caller_id_number')
                                        ->label('Caller ID Number')
                                        ->placeholder('e.g. 5551234567')
                                        ->helperText('Override caller number shown to agents.'),

                                    TextInput::make('ring_group_cid_name_prefix')
                                        ->label('CID Name Prefix')
                                        ->placeholder('e.g. Sales: ')
                                        ->helperText('Prepended to original caller name.'),

                                    TextInput::make('ring_group_cid_number_prefix')
                                        ->label('CID Number Prefix')
                                        ->placeholder('e.g. 1')
                                        ->helperText('Prepended to original caller number.'),
                                ]),

                            Section::make('Call Screening')
                                ->columns(2)
                                ->schema([
                                    Select::make('ring_group_call_screen_enabled')
                                        ->label('Call Screen')
                                        ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                        ->default('false')
                                        ->native(false)
                                        ->helperText('Prompt agents to press 1 before connecting.'),

                                    TextInput::make('ring_group_distinctive_ring')
                                        ->label('Distinctive Ring')
                                        ->placeholder('e.g. Bellcore-dr2')
                                        ->helperText('SIP Alert-Info header for distinctive ringtone.'),
                                ]),
                        ]),

                    // ── TAB 4: AUDIO ─────────────────────────────────────
                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Ringback & Greeting')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ring_group_greeting')
                                        ->label('Greeting')
                                        ->placeholder('phrase:greeting or /recordings/greeting.wav')
                                        ->helperText('Played to caller while waiting.')
                                        ->columnSpanFull(),

                                    TextInput::make('ring_group_ringback')
                                        ->label('Ringback')
                                        ->placeholder('local_stream://default')
                                        ->helperText('Music on hold or ringback tone for the caller.'),
                                ]),
                        ]),

                    // ── TAB 5: NOTIFICATIONS ─────────────────────────────
                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Missed Call Alerts')
                                ->description('Send alerts when calls go unanswered.')
                                ->columns(2)
                                ->schema([
                                    Select::make('ring_group_missed_call_app')
                                        ->label('Alert Method')
                                        ->options([
                                            ''      => '— None —',
                                            'email' => 'Email',
                                            'sms'   => 'SMS',
                                        ])
                                        ->default('')
                                        ->native(false),

                                    TextInput::make('ring_group_missed_call_data')
                                        ->label('Alert Destination')
                                        ->placeholder('email@example.com or +1234567890')
                                        ->helperText('Email address or phone number for alerts.'),
                                ]),
                        ]),

                    // ── TAB 6: ADVANCED ──────────────────────────────────
                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced Settings')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ring_group_context')
                                        ->label('Context')
                                        ->placeholder('default')
                                        ->helperText('Usually the domain name.'),
                                ]),
                        ]),
                ]),

            // ── Record Info (edit only) ───────────────────────────────────
            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('ring_group_uuid')->label('UUID')
                        ->content(fn($record) => $record?->ring_group_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->ring_group_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
