<?php

namespace App\Filament\Resources\Astpp\AutomatedReportLogResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AutomatedReportLogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Automated Report Log')
                ->columns(3)
                ->schema([
                    TextInput::make('filename')->label('Filename')->maxLength(100),
                    TextInput::make('usercode')->label('Usercode')->maxLength(50),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DatePicker::make('purge_date')->label('Purge Date'),
                ]),
        ]);
    }
}
