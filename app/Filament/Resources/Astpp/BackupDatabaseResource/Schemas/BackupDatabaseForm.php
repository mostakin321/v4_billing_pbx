<?php

namespace App\Filament\Resources\Astpp\BackupDatabaseResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BackupDatabaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Backup Database')
                ->columns(3)
                ->schema([
                    TextInput::make('backup_name')->label('Backup Name')->maxLength(100),
                    DateTimePicker::make('date')->label('Date'),
                    TextInput::make('path')->label('Path')->maxLength(100),
                ]),
        ]);
    }
}
