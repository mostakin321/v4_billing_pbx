<?php

namespace App\Filament\Resources\Astpp\PermissionResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Permissions')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(150),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    Toggle::make('login_type')->label('Login Type'),
                    Textarea::make('permissions')->label('Permissions')->rows(3)->columnSpanFull(),
                    Textarea::make('edit_permissions')->label('Edit Permissions')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('modification_date')->label('Modification Date'),
                ]),
        ]);
    }
}
