<?php

namespace App\Filament\Resources\Astpp\ReportsProcessListResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ReportsProcessListForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Reports Process List')
                ->columns(3)
                ->schema([
                    DateTimePicker::make('last_execution_date')->label('Last Execution Date'),
                    TextInput::make('name')->label('Name')->maxLength(50),
                ]),
        ]);
    }
}
