<?php
namespace App\Filament\Resources\Billing\OriginationRates\Schemas;

use App\Models\Billing\Account;
use App\Models\Billing\Pricelist;
use App\Models\Billing\Trunk;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\DB;

class OriginationRateForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Tabs::make('Origination Rate')->columnSpanFull()->tabs([

                Tabs\Tab::make('Rate Information')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        Section::make('Rate Group & Prefix')
                            ->description('Assign this rate to a reseller and rate plan.')
                            ->icon('heroicon-o-folder')
                            ->columns(3)
                            ->schema([
                                Select::make('reseller_id')
                                    ->label('Reseller')
                                    ->options(fn() => collect([0 => 'Admin (Default)'])
                                        ->merge(Account::where('type', 3)->where('status', 0)
                                            ->pluck('company_name', 'id')))
                                    ->default(0)->live()->searchable()
                                    ->helperText('Reseller who owns this rate. Also filters Rate Group list.'),

                                Select::make('pricelist_id')
                                    ->label('Rate Group / Plan')
                                    ->options(fn(Get $get) => Pricelist::where('status', 0)
                                        ->when((int)($get('reseller_id') ?? 0) > 0,
                                            fn($q) => $q->where('reseller_id', $get('reseller_id')))
                                        ->pluck('name', 'id'))
                                    ->required()->searchable()
                                    ->helperText('Rate group this prefix belongs to.'),

                                TextInput::make('pattern')
                                    ->label('Code / Prefix')
                                    ->required()->placeholder('880')
                                    ->live(debounce: 500)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                                        if (!$state) return;
                                        for ($i = strlen($state); $i >= 1; $i--) {
                                            $d = DB::table('countrycode')
                                                ->where('countrycode', substr($state, 0, $i))->first();
                                            if ($d) {
                                                $set('comment', $d->country);
                                                $set('country_id', $d->id);
                                                break;
                                            }
                                        }
                                    })
                                    ->helperText('Prefix of origination rate. Example: 880'),

                                TextInput::make('comment')
                                    ->label('Destination / Comment')
                                    ->placeholder('Auto-filled from prefix')
                                    ->helperText('Description for rate. Example: Bangladesh'),

                                Select::make('call_type')
                                    ->label('Call Type')
                                    ->options(fn() => DB::table('calltype')
                                        ->orderBy('call_type')
                                        ->pluck('call_type', 'id'))
                                    ->nullable()
                                    ->helperText('Select the call type (CLI, Non-CLI, IP Phone).'),

                                Select::make('country_id')
                                    ->label('Country')
                                    ->options(fn() => DB::table('countrycode')
                                        ->orderBy('country')
                                        ->pluck('country', 'id'))
                                    ->searchable()->nullable()
                                    ->helperText('Select appropriate country for this prefix.'),

                                Select::make('routing_type')
                                    ->label('Routing Type')
                                    ->options([
                                        '0' => 'LCR (Least Cost Routing)',
                                        '1' => 'Priority / Force',
                                    ])
                                    ->default('0')
                                    ->helperText('Routing strategy for call termination.'),

                                Select::make('trunk_id')
                                    ->label('Force Trunk (optional)')
                                    ->options(fn() => collect([0 => 'None (LCR)'])
                                        ->merge(Trunk::where('status', 0)->pluck('name', 'id')))
                                    ->default(0)->searchable()
                                    ->helperText('Force call to route using specific trunk.'),

                                Select::make('status')
                                    ->options([0 => 'Active', 1 => 'Inactive'])
                                    ->default(0)
                                    ->helperText('Status of Origination Rates (Active/Inactive).'),
                            ]),
                    ]),

                Tabs\Tab::make('Billing Information')
                    ->icon('heroicon-o-currency-dollar')
                    ->schema([
                        Section::make('Cost & Increments')
                            ->icon('heroicon-o-calculator')
                            ->columns(3)
                            ->schema([
                                TextInput::make('connectcost')
                                    ->label('Connect Cost ($)')
                                    ->numeric()->default(0)
                                    ->helperText('Connection fee charged when call connects.'),

                                TextInput::make('includedseconds')
                                    ->label('Included Seconds')
                                    ->numeric()->default(0)
                                    ->helperText('Free seconds per call, not billed.'),

                                TextInput::make('cost')
                                    ->label('Cost / Min ($)')
                                    ->numeric()->required()->default(0)
                                    ->helperText('Cost per minute.'),

                                TextInput::make('init_inc')
                                    ->label('Initial Increment (sec)')
                                    ->numeric()->default(60)
                                    ->helperText('First billing block in seconds.'),

                                TextInput::make('inc')
                                    ->label('Increment (sec)')
                                    ->numeric()->default(1)
                                    ->helperText('Subsequent billing increment. 60 = per minute, 1 = per second.'),

                                TextInput::make('precedence')
                                    ->label('Precedence')
                                    ->numeric()->default(0)
                                    ->helperText('Lower = higher priority.'),
                            ]),
                    ]),
            ]),

            Section::make('Record Info')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('created_info')->label('Created')
                        ->content(fn($record) => $record?->creation_date
                            ? Carbon::parse($record->creation_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('modified_info')->label('Modified')
                        ->content(fn($record) => $record?->last_modified_date
                            ? Carbon::parse($record->last_modified_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
