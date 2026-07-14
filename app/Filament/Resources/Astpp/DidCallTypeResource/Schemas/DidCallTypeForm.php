<?php

namespace App\Filament\Resources\Astpp\DidCallTypeResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DidCallTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Did Call Types')
                ->columns(3)
                ->schema([
                    TextInput::make('call_type_code')->label('Call Type Code')->maxLength(55),
                    Select::make('call_type')->label('Call Type')->relationship('calltype', 'id')->searchable()->preload(),
                ]),
        ]);
    }
}
