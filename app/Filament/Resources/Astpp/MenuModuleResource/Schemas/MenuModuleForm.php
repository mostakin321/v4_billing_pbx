<?php

namespace App\Filament\Resources\Astpp\MenuModuleResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MenuModuleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Menu Modules')
                ->columns(3)
                ->schema([
                    TextInput::make('menu_label')->label('Menu Label')->maxLength(25),
                    TextInput::make('module_name')->label('Module Name')->maxLength(25),
                    TextInput::make('module_url')->label('Module Url')->maxLength(100),
                    TextInput::make('menu_title')->label('Menu Title')->maxLength(20),
                    TextInput::make('menu_image')->label('Menu Image')->maxLength(25),
                    TextInput::make('menu_subtitle')->label('Menu Subtitle')->maxLength(20),
                    TextInput::make('priority')->label('Priority')->numeric(),
                ]),
        ]);
    }
}
