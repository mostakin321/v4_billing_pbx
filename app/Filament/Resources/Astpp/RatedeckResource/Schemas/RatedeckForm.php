<?php
namespace App\Filament\Resources\Astpp\RatedeckResource\Schemas;

use App\Models\Astpp\Account;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Facades\DB;

class RatedeckForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Ratedeck Information')
                ->description('Provider buy rates — what you pay the carrier. Used for margin calculation.')
                ->icon('heroicon-o-arrow-trending-down')
                ->columns(3)
                ->schema([
                    Select::make('reseller_id')
                        ->label('Reseller')
                        ->options(fn() => collect([0 => 'Admin (Default)'])
                            ->merge(Account::where('type', 3)->where('status', 0)
                                ->pluck('company_name', 'id')))
                        ->default(0)
                        ->searchable()
                        ->helperText('Reseller this buy rate belongs to'),

                    TextInput::make('pattern')
                        ->label('Code / Prefix')
                        ->required()
                        ->placeholder('880')
                        ->live(debounce: 500)
                        ->afterStateUpdated(function (Get $get, Set $set, ?string $state) {
                            if (!$state) return;
                            for ($i = strlen($state); $i >= 1; $i--) {
                                $d = DB::table('prefix_destinations')
                                    ->where('prefix', substr($state, 0, $i))->first();
                                if ($d) {
                                    $set('destination', $d->destination);
                                    $set('country_id',  $d->country_code);
                                    break;
                                }
                            }
                        })
                        ->helperText('Destination prefix. e.g. 880'),

                    TextInput::make('destination')
                        ->label('Destination')
                        ->placeholder('Auto-filled')
                        ->helperText('Destination name'),

                    Select::make('call_type')
                        ->label('Call Type')
                        ->options(fn() => DB::table('calltype')
                            ->where('status', 0)->pluck('call_type', 'id'))
                        ->nullable()
                        ->helperText('CLI / Non-CLI / IP Phone'),

                    Select::make('country_id')
                        ->label('Country')
                        ->options(fn() => DB::table('countrycode')
                            ->orderBy('country')->pluck('country', 'id'))
                        ->searchable()
                        ->nullable(),

                    Select::make('status')
                        ->options([0 => 'Active', 1 => 'Inactive'])
                        ->default(0),

                    TextInput::make('cost')
                        ->label('Buy Cost / Min ($)')
                        ->numeric()
                        ->required()
                        ->default(0)
                        ->helperText('What you pay the carrier per minute'),

                    TextInput::make('init_inc')
                        ->label('Initial Increment (sec)')
                        ->numeric()
                        ->default(60),

                    TextInput::make('inc')
                        ->label('Increment (sec)')
                        ->numeric()
                        ->default(1),
                ]),
        ]);
    }
}
