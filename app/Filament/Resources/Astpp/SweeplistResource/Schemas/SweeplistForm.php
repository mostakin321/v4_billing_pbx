<?php

namespace App\Filament\Resources\Astpp\SweeplistResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SweeplistForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Sweeplist')
                ->columns(3)
                ->schema([
                    TextInput::make('sweep')->label('Sweep')->maxLength(15),
                ]),
        ]);
    }
}
