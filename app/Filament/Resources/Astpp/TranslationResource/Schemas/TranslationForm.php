<?php

namespace App\Filament\Resources\Astpp\TranslationResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TranslationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Translations')
                ->columns(3)
                ->schema([
                    TextInput::make('module_name')->label('Module Name')->maxLength(255),
                    TextInput::make('en_En')->label('En En')->maxLength(255),
                ]),
        ]);
    }
}
