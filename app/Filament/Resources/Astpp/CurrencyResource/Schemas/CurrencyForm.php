<?php

namespace App\Filament\Resources\Astpp\CurrencyResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CurrencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Currency')
                ->columns(3)
                ->schema([
                    TextInput::make('currency')->label('Currency')->maxLength(3),
                    TextInput::make('currencyname')->label('Currencyname')->maxLength(40),
                    TextInput::make('currencyrate')->label('Currencyrate')->numeric(),
                    DateTimePicker::make('last_updated')->label('Last Updated'),
                    Toggle::make('is_supported')->label('Is Supported'),
                ]),
        ]);
    }
}
