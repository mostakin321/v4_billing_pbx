<?php
namespace App\Filament\Resources\Billing\Pricelists\Schemas;

use App\Models\Billing\Account;
use App\Models\Billing\Pricelist;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\DB;

class PricelistForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Section::make('Basic')->icon('heroicon-o-document-text')->columns(3)->schema([

                Select::make('reseller_id')->label('Reseller')
                    ->options(fn() => collect(['0' => 'Admin'])
                        ->merge(Account::where('type', 3)->where('status', 0)->where('deleted', 0)->pluck('company_name', 'id')))
                    ->default(0)->searchable()
                    ->helperText('Parent reseller who owns this rate group'),

                TextInput::make('name')->label('Name *')->required()->maxLength(30)
                    ->placeholder('Gold-Rates'),

                TextInput::make('routing_prefix')->label('Routing Prefix')
                    ->placeholder('7777')
                    ->helperText('Customer dials this prefix to use this rate group'),

                Select::make('shadow_billing')->label('Shadow Billing')
                    ->options(fn() => collect(['0' => '--Select--'])
                        ->merge(Account::where('type', 3)->where('status', 0)->pluck('company_name', 'id')))
                    ->default(0)->searchable()
                    ->helperText('Reseller account for shadow billing'),

                Select::make('status')->label('Status')
                    ->options([0 => 'Active', 1 => 'Inactive'])
                    ->default(0)->required(),

                Select::make('decimal_points')->label('Decimal Points')
                    ->options([1=>1, 2=>2, 3=>3, 4=>4, 5=>5])
                    ->default(4)
                    ->helperText('Rate precision (decimal places)'),

                Select::make('usable_for_reseller')->label('Usable For Reseller')
                    ->options([1 => 'Yes', 0 => 'No'])
                    ->default(0)
                    ->helperText('Yes = Reseller can assign this rate group to their customers')
                    ->disabledOn('edit'), // Cannot change after creation per ASTPP docs
            ]),

            Section::make('Billing')->icon('heroicon-o-currency-dollar')->columns(3)->schema([

                TextInput::make('markup')->label('Markup (%)')
                    ->numeric()->default(0)
                    ->helperText('E.g. 10% markup on $1 call = $1.10 charged to customer'),

                TextInput::make('initially_increment')->label('Initial Increment *')
                    ->numeric()->default(1)->required()
                    ->helperText('Minimum billing seconds charged'),

                TextInput::make('inc')->label('Increment *')
                    ->numeric()->default(1)->required()
                    ->helperText('E.g. 60 = charge per minute'),

                Select::make('routing_type')->label('Routing Type')
                    ->options([
                        0 => 'LCR (Lowest Cost Routing)',
                        1 => 'Priority',
                        2 => 'Percentage',
                        3 => 'Round Robin',
                    ])
                    ->default(0)->required(),

                Select::make('trunk_ids')->label('Trunks')
                    ->multiple()
                    ->options(fn() => DB::table('trunks')->where('status', 0)->pluck('name', 'id'))
                    ->helperText('No trunks = outbound calls blocked for customers in this group')
                    ->dehydrated(false)
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record) {
                            $trunkIds = DB::table('routes')
                                ->where('pricelist_id', $record->id)
                                ->whereNotNull('trunk_id')
                                ->pluck('trunk_id')
                                ->map(fn($t) => explode(',', $t))
                                ->flatten()->unique()->filter()
                                ->values()->toArray();
                            $component->state($trunkIds);
                        }
                    }),
            ]),
        ]);
    }
}
