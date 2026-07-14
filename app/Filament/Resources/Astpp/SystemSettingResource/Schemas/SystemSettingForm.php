<?php

namespace App\Filament\Resources\Astpp\SystemSettingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SystemSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('System')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(48),
                    TextInput::make('display_name')->label('Display Name')->maxLength(255),
                    TextInput::make('value')->label('Value')->maxLength(1111),
                    TextInput::make('field_type')->label('Field Type')->maxLength(250),
                    Textarea::make('comment')->label('Comment')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('timestamp')->label('Timestamp'),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Toggle::make('is_display')->label('Is Display'),
                    TextInput::make('group_title')->label('Group Title')->maxLength(50),
                    TextInput::make('sub_group')->label('Sub Group')->maxLength(200),
                    TextInput::make('field_rules')->label('Field Rules')->maxLength(80),
                ]),
        ]);
    }
}
