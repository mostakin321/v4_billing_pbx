<?php

namespace App\Filament\Resources\Astpp\LanguageResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LanguageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Languages')
                ->columns(3)
                ->schema([
                    TextInput::make('code')->label('Code')->maxLength(5),
                    TextInput::make('name')->label('Name')->maxLength(50),
                    TextInput::make('locale')->label('Locale')->maxLength(50),
                ]),
        ]);
    }
}
