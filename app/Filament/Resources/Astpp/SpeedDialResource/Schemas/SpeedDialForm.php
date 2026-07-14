<?php

namespace App\Filament\Resources\Astpp\SpeedDialResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SpeedDialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Speed Dial')
                ->columns(3)
                ->schema([
                    TextInput::make('speed_num')->label('Speed Num')->numeric(),
                    TextInput::make('number')->label('Number')->maxLength(15),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                ]),
        ]);
    }
}
