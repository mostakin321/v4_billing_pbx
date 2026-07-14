<?php

namespace App\Filament\Resources\Astpp\AccessnumberResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccessnumberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Accessnumber')
                ->columns(3)
                ->schema([
                    TextInput::make('access_number')->label('Access Number')->maxLength(25),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    Toggle::make('status')->label('Status'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                ]),
        ]);
    }
}
