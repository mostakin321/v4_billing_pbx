<?php

namespace App\Filament\Resources\Astpp\CountryCodeResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CountryCodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Countrycode')
                ->columns(3)
                ->schema([
                    Select::make('currency_id')->label('Currency ID')->relationship('currency', 'currency')->searchable()->preload(),
                    TextInput::make('iso')->label('Iso')->maxLength(2),
                    TextInput::make('country')->label('Country')->maxLength(80),
                    TextInput::make('nicename')->label('Nicename')->maxLength(80),
                    TextInput::make('iso3')->label('Iso3')->maxLength(3),
                    TextInput::make('countrycode')->label('Countrycode')->numeric(),
                    TextInput::make('vat')->label('Vat')->numeric(),
                    TextInput::make('latitude')->label('Latitude')->maxLength(20),
                    TextInput::make('longitude')->label('Longitude')->maxLength(20),
                    TextInput::make('capital')->label('Capital')->maxLength(20),
                ]),
        ]);
    }
}
