<?php

namespace App\Filament\Resources\Astpp\RolePermissionResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RolePermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Roles And Permission')
                ->columns(3)
                ->schema([
                    Toggle::make('login_type')->label('Login Type'),
                    Toggle::make('permission_type')->label('Permission Type'),
                    TextInput::make('menu_name')->label('Menu Name')->maxLength(50),
                    TextInput::make('module_name')->label('Module Name')->maxLength(50),
                    TextInput::make('sub_module_name')->label('Sub Module Name')->maxLength(50),
                    TextInput::make('module_url')->label('Module Url')->maxLength(50),
                    TextInput::make('display_name')->label('Display Name')->maxLength(100),
                    Textarea::make('permissions')->label('Permissions')->rows(3)->columnSpanFull(),
                    Toggle::make('status')->label('Status'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    TextInput::make('priority')->label('Priority')->numeric(),
                ]),
        ]);
    }
}
