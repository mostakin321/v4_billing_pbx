<?php

namespace App\Filament\Resources\Astpp\CronSettingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CronSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Cron Settings')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(50),
                    TextInput::make('command')->label('Command')->maxLength(50),
                    TextInput::make('exec_interval')->label('Exec Interval')->numeric(),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                    DateTimePicker::make('last_execution_date')->label('Last Execution Date'),
                    DateTimePicker::make('next_execution_date')->label('Next Execution Date'),
                    Toggle::make('status')->label('Status'),
                    TextInput::make('file_path')->label('File Path')->maxLength(200),
                ]),
        ]);
    }
}
