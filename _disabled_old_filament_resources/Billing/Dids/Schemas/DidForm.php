<?php
namespace App\Filament\Resources\Billing\Dids\Schemas;

use App\Models\Billing\Account;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class DidForm
{
    protected static function callTypeOptions(): array
    {
        return [
            0 => 'Local Extension',
            1 => 'SIP URI',
            2 => 'Direct IP',
            3 => 'Custom',
            4 => 'Transfer/Forward',
        ];
    }

    protected static function forwardOptions(): array
    {
        return [
            0 => 'Disabled',
            1 => 'Forward',
            2 => 'Voicemail',
        ];
    }

    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Tabs::make('DID')->columnSpanFull()->tabs([

                // ── Tab 1: Basic Info ────────────────────────────────────────
                Tabs\Tab::make('Basic Info')->icon('heroicon-o-phone-arrow-down-left')->schema([

                    Section::make('DID Information')->columns(3)->schema([

                        TextInput::make('number')->label('DID Number *')
                            ->required()->placeholder('+8809612345678')
                            ->helperText('Full DID number in E.164 format'),

                        Select::make('country_id')->label('Country')
                            ->options(fn() => DB::table('countrycode')->orderBy('country')->pluck('country','id'))
                            ->searchable()->default(0),

                        TextInput::make('province')->label('Province/State'),
                        TextInput::make('city')->label('City'),

                        Select::make('provider_id')->label('Provider')
                            ->options(fn() => collect(['0'=>'-- None --'])
                                ->merge(Account::where('type',2)->where('status',0)->where('deleted',0)
                                    ->pluck('company_name','id')))
                            ->searchable()->default(0)
                            ->helperText('Provider/vendor this DID is purchased from'),

                        Select::make('accountid')->label('Assigned Account')
                            ->options(fn() => collect(['0'=>'-- Unassigned --'])
                                ->merge(Account::where('status',0)->where('deleted',0)
                                    ->whereIn('type',[0,3])
                                    ->get()->mapWithKeys(fn($a) => [
                                        $a->id => $a->number.' — '.($a->company_name ?: $a->first_name)
                                    ])))
                            ->searchable()->default(0),

                        Select::make('parent_id')->label('Reseller Pool')
                            ->options(fn() => collect(['0'=>'-- None --'])
                                ->merge(Account::where('type',3)->where('status',0)->pluck('company_name','id')))
                            ->searchable()->default(0),

                        Select::make('status')->label('Status')
                            ->options([0=>'Active', 1=>'Inactive'])
                            ->default(0)->required(),

                        Select::make('product_id')->label('Product')
                            ->options(fn() => collect(['0'=>'-- None --'])
                                ->merge(DB::table('products')->where('status',0)->pluck('name','id')->toArray()))
                            ->default(0)->searchable(),
                    ]),
                ]),

                // ── Tab 2: Billing ───────────────────────────────────────────
                Tabs\Tab::make('Billing')->icon('heroicon-o-currency-dollar')->schema([

                    Section::make('Call Billing')->columns(3)->schema([

                        TextInput::make('connectcost')->label('Connection Cost ($)')
                            ->numeric()->default(0)
                            ->helperText('One-time fee when call connects'),

                        TextInput::make('includedseconds')->label('Grace Time (sec.)')
                            ->numeric()->default(0)
                            ->helperText('Free seconds at start of each call'),

                        TextInput::make('cost')->label('Cost/Min ($)')
                            ->numeric()->default(0),

                        TextInput::make('init_inc')->label('Initial Increment (sec.)')
                            ->numeric()->default(60)
                            ->helperText('Minimum billing seconds'),

                        TextInput::make('inc')->label('Increment (sec.)')
                            ->numeric()->default(1)
                            ->helperText('Billing block after initial increment'),

                        TextInput::make('setup')->label('Setup Fee ($)')
                            ->numeric()->default(0)
                            ->helperText('One-time setup fee'),

                        TextInput::make('monthlycost')->label('DID Fee / Monthly ($)')
                            ->numeric()->default(0)
                            ->helperText('Recurring monthly cost for this DID'),

                        TextInput::make('maxchannels')->label('Concurrent Calls')
                            ->numeric()->default(0)
                            ->helperText('0 = unlimited'),

                        TextInput::make('leg_timeout')->label('Call Timeout (sec.)')
                            ->numeric()->default(30)
                            ->helperText('Auto hangup if not answered'),
                    ]),
                ]),

                // ── Tab 3: Call Routing ──────────────────────────────────────
                Tabs\Tab::make('Call Routing')->icon('heroicon-o-arrow-path')->schema([

                    Section::make('Primary Routing')->columns(2)->schema([

                        Select::make('call_type')->label('Call Type')
                            ->options(self::callTypeOptions())
                            ->default(0)->required()->live(),

                        TextInput::make('extensions')->label('Destination / Extension')
                            ->placeholder('1001 or sip:user@domain.com')
                            ->helperText('Extension, SIP URI or IP. Comma-separate for multiple.'),
                    ]),

                    Section::make('Failover Routing')->columns(2)->schema([

                        Select::make('failover_call_type')->label('Failover Call Type')
                            ->options(self::callTypeOptions())
                            ->default(1),

                        TextInput::make('failover_extensions')->label('Failover Destination')
                            ->placeholder('sip:backup@domain.com')->nullable(),
                    ]),
                ]),

                // ── Tab 4: Action - Always ───────────────────────────────────
                Tabs\Tab::make('Always')->icon('heroicon-o-arrow-right-circle')->schema([
                    Section::make('Always Forward')->columns(3)
                        ->description('Always forward all calls regardless of status')->schema([

                        Select::make('always')->label('Action')
                            ->options(self::forwardOptions())->default(0),

                        TextInput::make('always_destination')->label('Destination')
                            ->placeholder('sip:number@domain or extension')->nullable(),

                        Select::make('always_vm_flag')->label('Voicemail')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),
                    ]),
                ]),

                // ── Tab 5: Action - User Busy ────────────────────────────────
                Tabs\Tab::make('User Busy')->icon('heroicon-o-x-circle')->schema([
                    Section::make('User Busy')->columns(3)
                        ->description('Action when called extension is busy')->schema([

                        Select::make('user_busy')->label('Action')
                            ->options(self::forwardOptions())->default(0),

                        TextInput::make('user_busy_destination')->label('Destination')
                            ->placeholder('sip:voicemail@domain or extension')->nullable(),

                        Select::make('user_busy_vm_flag')->label('Voicemail')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),
                    ]),
                ]),

                // ── Tab 6: Action - Not Registered ──────────────────────────
                Tabs\Tab::make('Not Registered')->icon('heroicon-o-signal-slash')->schema([
                    Section::make('User Not Registered')->columns(3)
                        ->description('Action when called extension is not registered/online')->schema([

                        Select::make('user_not_registered')->label('Action')
                            ->options(self::forwardOptions())->default(0),

                        TextInput::make('user_not_registered_destination')->label('Destination')
                            ->placeholder('sip:backup@domain')->nullable(),

                        Select::make('user_not_registered_vm_flag')->label('Voicemail')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),
                    ]),
                ]),

                // ── Tab 7: Action - No Answer ────────────────────────────────
                Tabs\Tab::make('No Answer')->icon('heroicon-o-phone-x-mark')->schema([
                    Section::make('No Answer')->columns(3)
                        ->description('Action when called extension does not answer')->schema([

                        Select::make('no_answer')->label('Action')
                            ->options(self::forwardOptions())->default(0),

                        TextInput::make('no_answer_destination')->label('Destination')
                            ->placeholder('sip:voicemail@domain')->nullable(),

                        Select::make('no_answer_vm_flag')->label('Voicemail')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),

                        Select::make('call_type_vm_flag')->label('Call Type VM Flag')
                            ->options([1=>'Enabled', 0=>'Disabled'])->default(1),
                    ]),
                ]),

            ]),
        ]);
    }
}
