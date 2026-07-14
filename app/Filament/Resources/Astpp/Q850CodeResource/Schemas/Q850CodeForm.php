<?php

namespace App\Filament\Resources\Astpp\Q850CodeResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Q850CodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Q850Code')
                ->columns(3)
                ->schema([
                    TextInput::make('cause')->label('Cause')->maxLength(70),
                    TextInput::make('code')->label('Code')->numeric(),
                ]),
        ]);
    }
}
