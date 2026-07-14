<?php

namespace App\Filament\Resources\Astpp\FreeswichServerResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class FreeswichServerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Freeswich Servers')
                ->columns(3)
                ->schema([
                    TextInput::make('freeswitch_host')->label('Freeswitch Host')->maxLength(100),
                    TextInput::make('freeswitch_password')->label('Freeswitch Password')->maxLength(50),
                    TextInput::make('freeswitch_port')->label('Freeswitch Port')->maxLength(10),
                    Toggle::make('status')->label('Status'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                ]),
        ]);
    }
}
