<?php

namespace App\Filament\Resources\Astpp\LoginActivityReportResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LoginActivityReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Login Activity Report')
                ->columns(3)
                ->schema([
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('user_agent')->label('User Agent')->maxLength(255),
                    TextInput::make('country_name')->label('Country Name')->maxLength(200),
                    TextInput::make('ip')->label('IP')->maxLength(255),
                    DateTimePicker::make('timestamp')->label('Timestamp'),
                ]),
        ]);
    }
}
