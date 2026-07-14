<?php

namespace App\Filament\Resources\Astpp\TimezoneResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TimezoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Timezone')
                ->columns(3)
                ->schema([
                    TextInput::make('gmttime')->label('Gmttime')->maxLength(255),
                    TextInput::make('gmtoffset')->label('Gmtoffset')->numeric(),
                    TextInput::make('timezone_name')->label('Timezone Name')->maxLength(255),
                    TextInput::make('timezone_digit')->label('Timezone Digit')->maxLength(60),
                ]),
        ]);
    }
}
