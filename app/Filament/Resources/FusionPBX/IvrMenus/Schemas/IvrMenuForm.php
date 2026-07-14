<?php

namespace App\Filament\Resources\FusionPBX\IvrMenus\Schemas;

use App\Models\FusionPBX\IvrMenu;
use App\Models\FusionPBX\Recording;
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

class IvrMenuForm
{
    /**
     * Destination options for IVR option param:
     * Returns grouped options for the action:param select.
     */
    private static function destinationOptions(): array
    {
        $groups = [];

        // Common transfer destinations - extensions
        $groups['Transfer to Extension'] = [
            'transfer:1000 XML default' => '1000',
            'transfer:1001 XML default' => '1001',
            'transfer:1002 XML default' => '1002',
            'transfer:1003 XML default' => '1003',
            'transfer:1004 XML default' => '1004',
            'transfer:1005 XML default' => '1005',
        ];

        // Voicemail
        $groups['Voicemail'] = [
            'transfer:*98 XML default'  => 'Check Voicemail (*98)',
            'transfer:*99 XML default'  => 'Voicemail Direct (*99)',
        ];

        // IVR Menus (other menus)
        try {
            $menus = IvrMenu::orderBy('ivr_menu_name')->get();
            if ($menus->count()) {
                $groups['IVR Menus'] = $menus->mapWithKeys(fn($m) =>
                    ['transfer:' . $m->ivr_menu_extension . ' XML default' => $m->ivr_menu_name]
                )->toArray();
            }
        } catch (\Exception $e) {}

        // Special actions
        $groups['Special Actions'] = [
            'menu-exit'         => 'Exit Menu',
            'menu-back'         => 'Return to Parent Menu',
            'menu-top'          => 'Return to Top Menu',
            'menu-exec-app'     => 'Execute Application',
            'playback'          => 'Playback File',
        ];

        return $groups;
    }

    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('IVR Menu')
                ->columnSpanFull()
                ->tabs([

                    // ── TAB 1: MAIN ──────────────────────────────────────
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-phone')
                        ->schema([

                            Section::make('IVR Identity')
                                ->description('Basic identity and parent menu.')
                                ->columns(3)
                                ->schema([
                                    TextInput::make('ivr_menu_name')
                                        ->label('Name')
                                        ->required()
                                        ->placeholder('e.g. Main Menu')
                                        ->columnSpan(2),

                                    Select::make('ivr_menu_enabled')
                                        ->label('Status')
                                        ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                        ->default('true')
                                        ->native(false),

                                    TextInput::make('ivr_menu_extension')
                                        ->label('Extension')
                                        ->placeholder('e.g. 7000')
                                        ->helperText('Callers dial this to reach the menu.'),

                                    Select::make('ivr_menu_parent_uuid')
                                        ->label('Parent Menu')
                                        ->options(function () {
                                            try {
                                                return IvrMenu::orderBy('ivr_menu_name')
                                                    ->pluck('ivr_menu_name', 'ivr_menu_uuid')
                                                    ->toArray();
                                            } catch (\Exception $e) { return []; }
                                        })
                                        ->searchable()
                                        ->placeholder('— None (top-level) —')
                                        ->helperText('Set for sub-menus.'),

                                    TextInput::make('ivr_menu_context')
                                        ->label('Context')
                                        ->placeholder('default')
                                        ->helperText('Usually the domain name.'),

                                    Textarea::make('ivr_menu_description')
                                        ->label('Description')
                                        ->rows(2)
                                        ->columnSpanFull(),
                                ]),

                            // ── OPTIONS REPEATER ─────────────────────────
                            Section::make('Menu Options')
                                ->description('Define what happens when a caller presses each digit.')
                                ->icon('heroicon-o-list-bullet')
                                ->schema([
                                    Repeater::make('ivrMenuOptions')
                                        ->label('')
                                        ->relationship('options')
                                        ->schema([
                                            TextInput::make('ivr_menu_option_digits')
                                                ->label('Digit')
                                                ->placeholder('0–9, #, *')
                                                ->maxLength(5)
                                                ->required(),

                                            TextInput::make('ivr_menu_option_param')
                                                ->label('Destination')
                                                ->placeholder('transfer:1001 XML default')
                                                ->helperText('action:param — e.g. transfer:1001 XML default')
                                                ->columnSpan(2),

                                            Select::make('ivr_menu_option_order')
                                                ->label('Order')
                                                ->options(collect(range(0, 99))->mapWithKeys(fn($n) => [
                                                    (string)($n * 10) => str_pad($n * 10, 3, '0', STR_PAD_LEFT)
                                                ])->toArray())
                                                ->default('0')
                                                ->native(false),

                                            TextInput::make('ivr_menu_option_description')
                                                ->label('Description')
                                                ->placeholder('e.g. Sales')
                                                ->columnSpan(2),

                                            Select::make('ivr_menu_option_enabled')
                                                ->label('Enabled')
                                                ->options(['true' => 'Yes', 'false' => 'No'])
                                                ->default('true')
                                                ->native(false),
                                        ])
                                        ->columns(7)
                                        ->defaultItems(5)
                                        ->addActionLabel('Add Option')
                                        ->reorderable()
                                        ->reorderableWithButtons()
                                        ->collapsible()
                                        ->itemLabel(fn(array $state): ?string =>
                                            isset($state['ivr_menu_option_digits'])
                                                ? 'Press ' . $state['ivr_menu_option_digits'] . ($state['ivr_menu_option_description'] ? ' — ' . $state['ivr_menu_option_description'] : '')
                                                : null
                                        ),
                                ]),
                        ]),

                    // ── TAB 2: AUDIO ─────────────────────────────────────
                    Tabs\Tab::make('Audio & Greetings')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Greetings')
                                ->description('Audio files played when entering or returning to this menu.')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ivr_menu_greet_long')
                                        ->label('Greet Long')
                                        ->placeholder('phrase:mainmenu or /recordings/greeting.wav')
                                        ->helperText('Played when caller first enters the menu.'),

                                    TextInput::make('ivr_menu_greet_short')
                                        ->label('Greet Short')
                                        ->placeholder('phrase:mainmenu_short or /recordings/short.wav')
                                        ->helperText('Played when caller returns to menu.'),

                                    TextInput::make('ivr_menu_invalid_sound')
                                        ->label('Invalid Sound')
                                        ->placeholder('ivr/ivr-that_was_an_invalid_entry.wav')
                                        ->helperText('Played on invalid digit entry.'),

                                    TextInput::make('ivr_menu_exit_sound')
                                        ->label('Exit Sound')
                                        ->placeholder('voicemail/vm-goodbye.wav')
                                        ->helperText('Played when exiting the menu.'),

                                    TextInput::make('ivr_menu_ringback')
                                        ->label('Ringback')
                                        ->placeholder('local_stream://default')
                                        ->helperText('Music on hold while connecting.'),
                                ]),

                            Section::make('Text-to-Speech')
                                ->columns(3)
                                ->collapsed()
                                ->schema([
                                    TextInput::make('ivr_menu_language')
                                        ->label('Language')->placeholder('en'),
                                    TextInput::make('ivr_menu_dialect')
                                        ->label('Dialect')->placeholder('us'),
                                    TextInput::make('ivr_menu_voice')
                                        ->label('Voice')->placeholder('Callie'),
                                    TextInput::make('ivr_menu_tts_engine')
                                        ->label('TTS Engine')->placeholder('flite'),
                                    TextInput::make('ivr_menu_tts_voice')
                                        ->label('TTS Voice')->placeholder('kal'),
                                ]),
                        ]),

                    // ── TAB 3: TIMEOUT & BEHAVIOR ────────────────────────
                    Tabs\Tab::make('Timeout & Behavior')
                        ->icon('heroicon-o-clock')
                        ->schema([
                            Section::make('Timing')
                                ->columns(3)
                                ->schema([
                                    TextInput::make('ivr_menu_timeout')
                                        ->label('Timeout (ms)')
                                        ->numeric()
                                        ->default(3000)
                                        ->placeholder('3000')
                                        ->helperText('Wait after playing greeting (milliseconds).'),

                                    TextInput::make('ivr_menu_inter_digit_timeout')
                                        ->label('Inter-Digit Timeout (ms)')
                                        ->numeric()
                                        ->placeholder('2000')
                                        ->helperText('Wait between digits.'),

                                    TextInput::make('ivr_menu_digit_len')
                                        ->label('Max Digits')
                                        ->numeric()
                                        ->placeholder('1')
                                        ->helperText('Number of digits to collect.'),

                                    TextInput::make('ivr_menu_max_failures')
                                        ->label('Max Failures')
                                        ->numeric()
                                        ->placeholder('3')
                                        ->helperText('Invalid entries before exit.'),

                                    TextInput::make('ivr_menu_max_timeouts')
                                        ->label('Max Timeouts')
                                        ->numeric()
                                        ->placeholder('3')
                                        ->helperText('Timeouts before exit.'),

                                    TextInput::make('ivr_menu_confirm_attempts')
                                        ->label('Confirm Attempts')
                                        ->numeric()
                                        ->placeholder('3'),
                                ]),

                            Section::make('Exit Action')
                                ->description('What happens when the menu exits (max failures/timeouts reached).')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('ivr_menu_exit_app')
                                        ->label('Exit Application')
                                        ->placeholder('transfer')
                                        ->helperText('FreeSWITCH app: transfer, hangup, playback...'),

                                    TextInput::make('ivr_menu_exit_data')
                                        ->label('Exit Data')
                                        ->placeholder('1001 XML default')
                                        ->helperText('Parameter passed to exit application.'),
                                ]),

                            Section::make('Confirmation')
                                ->columns(2)
                                ->collapsed()
                                ->schema([
                                    TextInput::make('ivr_menu_confirm_macro')
                                        ->label('Confirm Macro')
                                        ->placeholder('confirm macro'),
                                    TextInput::make('ivr_menu_confirm_key')
                                        ->label('Confirm Key')
                                        ->placeholder('e.g. 1'),
                                ]),
                        ]),

                    // ── TAB 4: CALLER ID & ADVANCED ──────────────────────
                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')->columns(2)->schema([
                                TextInput::make('ivr_menu_cid_prefix')
                                    ->label('CID Prefix')
                                    ->placeholder('e.g. IVR:')
                                    ->helperText('Prepended to caller ID name.'),
                                Select::make('ivr_menu_direct_dial')
                                    ->label('Direct Dial')
                                    ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                    ->default('false')
                                    ->native(false)
                                    ->helperText('Allow callers to dial extensions directly.'),
                                TextInput::make('ivr_menu_pin_number')
                                    ->label('PIN Number')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Require PIN to access this menu.'),
                            ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('ivr_menu_uuid')->label('UUID')
                        ->content(fn($record) => $record?->ivr_menu_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->ivr_menu_uuid.'</code>')
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
