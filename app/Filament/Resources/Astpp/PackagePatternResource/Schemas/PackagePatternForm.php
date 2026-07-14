<?php

namespace App\Filament\Resources\Astpp\PackagePatternResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PackagePatternForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Package Patterns')
                ->columns(3)
                ->schema([
                    Select::make('product_id')->label('Product ID')->relationship('product', 'name')->searchable()->preload(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    TextInput::make('patterns')->label('Patterns')->maxLength(50),
                    TextInput::make('destination')->label('Destination')->maxLength(100),
                ]),
        ]);
    }
}
