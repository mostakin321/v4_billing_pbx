<?php
namespace App\Filament\Resources\Billing\Rates\Schemas;

use App\Models\Billing\Account;
use App\Models\Billing\Pricelist;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\DB;

class RateForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Rate Information')
                ->icon('heroicon-o-currency-dollar')
                ->columns(3)
                ->schema([
                    Select::make('reseller_id')->label('Reseller')
                        ->options(fn() => collect([0 => 'Admin (Default)'])
                            ->merge(Account::where('type', 3)->where('status', 0)
                                ->pluck('company_name', 'id')))
                        ->default(0)->live()->searchable(),

                    Select::make('pricelist_id')->label('Rate Group')
                        ->options(fn(Get $get) => Pricelist::where('status', 0)
                            ->when((int)($get('reseller_id') ?? 0) > 0,
                                fn($q) => $q->where('reseller_id', $get('reseller_id')))
                            ->pluck('name', 'id'))
                        ->required()->searchable(),

                    TextInput::make('pattern')->label('Prefix')
                        ->required()->placeholder('880')
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                            if (!$state) return;
                            for ($i = strlen($state); $i >= 1; $i--) {
                                $d = DB::table('countrycode')
                                    ->where('countrycode', substr($state, 0, $i))->first();
                                if ($d) { $set('comment', $d->country); $set('country_id', $d->id); break; }
                            }
                        })
                        ->helperText('e.g. 880, 8801, 91'),

                    TextInput::make('comment')->label('Destination')
                        ->placeholder('Auto-filled from prefix'),

                    Select::make('call_type')->label('Call Type')
                        ->options(fn() => DB::table('calltype')
                            ->orderBy('call_type')->pluck('call_type', 'id'))
                        ->nullable(),

                    Select::make('country_id')->label('Country')
                        ->options(fn() => DB::table('countrycode')
                            ->orderBy('country')->pluck('country', 'id'))
                        ->searchable()->nullable(),

                    Select::make('routing_type')->label('Routing Type')
                        ->options(['0' => 'LCR', '1' => 'Priority'])->default('0'),

                    Select::make('trunk_id')->label('Force Trunk')
                        ->options(fn() => collect([0 => 'None (LCR)'])
                            ->merge(\App\Models\Billing\Trunk::where('status', 0)->pluck('name', 'id')))
                        ->default(0)->searchable(),

                    Select::make('status')
                        ->options([0 => 'Active', 1 => 'Inactive'])->default(0),
                ]),

            Section::make('Billing')
                ->icon('heroicon-o-calculator')
                ->columns(3)
                ->schema([
                    TextInput::make('cost')->label('Cost/Min ($)')
                        ->numeric()->required()->default(0),

                    TextInput::make('connectcost')->label('Connect Cost ($)')
                        ->numeric()->default(0),

                    TextInput::make('includedseconds')->label('Included Seconds')
                        ->numeric()->default(0),

                    TextInput::make('init_inc')->label('Initial Increment (sec)')
                        ->numeric()->default(60),

                    TextInput::make('inc')->label('Increment (sec)')
                        ->numeric()->default(1),

                    TextInput::make('precedence')->label('Precedence')
                        ->numeric()->default(0),
                ]),
        ]);
    }
}
