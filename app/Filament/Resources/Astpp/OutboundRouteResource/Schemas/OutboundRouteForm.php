<?php
namespace App\Filament\Resources\Astpp\OutboundRouteResource\Schemas;

use App\Models\Astpp\Trunk;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\DB;

class OutboundRouteForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Termination Route')->columns(3)->schema([
                Select::make('trunk_id')->label('Trunk')
                    ->options(fn() => Trunk::where('status', 0)->pluck('name', 'id'))
                    ->required()->searchable()
                    ->helperText('Carrier trunk to send call through'),

                TextInput::make('pattern')->label('Prefix/Pattern')
                    ->required()->placeholder('880')
                    ->helperText('Destination prefix e.g. 880, 1, 44'),

                TextInput::make('comment')->label('Destination')
                    ->placeholder('Bangladesh')
                    ->helperText('Description of this route'),

                Select::make('reseller_id')->label('Reseller')
                    ->options(fn() => collect([0 => 'Admin (Default)'])
                        ->merge(\App\Models\Astpp\Account::where('type', 3)
                            ->where('status', 0)->pluck('company_name', 'id')))
                    ->default(0)->searchable(),

                Select::make('status')
                    ->options([0 => 'Active', 1 => 'Inactive'])->default(0),
            ]),

            Section::make('Billing & Routing')->columns(3)->schema([
                TextInput::make('cost')->label('Cost/Min ($)')
                    ->numeric()->default(0)
                    ->helperText('Buy cost per minute from carrier'),

                TextInput::make('connectcost')->label('Connect Cost ($)')
                    ->numeric()->default(0),

                TextInput::make('init_inc')->label('Initial Increment (sec)')
                    ->numeric()->default(60),

                TextInput::make('inc')->label('Increment (sec)')
                    ->numeric()->default(1),

                TextInput::make('strip')->label('Strip Digits')
                    ->numeric()->default(0)
                    ->helperText('Digits to strip from called number'),

                TextInput::make('prepend')->label('Prepend')
                    ->placeholder('+880')
                    ->helperText('Digits to prepend to called number'),

                TextInput::make('precedence')->label('Priority')
                    ->numeric()->default(0)
                    ->helperText('Lower = higher priority'),
            ]),
        ]);
    }
}
