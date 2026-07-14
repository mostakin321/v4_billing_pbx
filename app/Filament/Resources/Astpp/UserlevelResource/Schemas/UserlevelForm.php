<?php

namespace App\Filament\Resources\Astpp\UserlevelResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserlevelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Userlevels')
                ->columns(3)
                ->schema([
                    TextInput::make('userlevelid')->label('Userlevelid')->numeric(),
                    TextInput::make('userlevelname')->label('Userlevelname')->maxLength(15),
                    TextInput::make('module_permissions')->label('Module Permissions')->maxLength(2000),
                ]),
        ]);
    }
}
