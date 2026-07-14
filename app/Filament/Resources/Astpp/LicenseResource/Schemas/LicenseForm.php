<?php

namespace App\Filament\Resources\Astpp\LicenseResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LicenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('License')
                ->columns(3)
                ->schema([
                    TextInput::make('license_key')->label('License Key')->maxLength(30),
                    Textarea::make('localkey')->label('Localkey')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('created_date')->label('Created Date'),
                    DateTimePicker::make('last_updated_date')->label('Last Updated Date'),
                ]),
        ]);
    }
}
