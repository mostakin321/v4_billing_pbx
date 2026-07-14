<?php

namespace App\Filament\Resources\Astpp\AccountUnverifiedResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountUnverifiedForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Account Unverified')
                ->columns(3)
                ->schema([
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('number')->label('Number')->maxLength(20),
                    TextInput::make('telephone')->label('Telephone')->maxLength(20),
                    TextInput::make('password')->label('Password')->password()->revealable()->maxLength(100),
                    TextInput::make('first_name')->label('First Name')->maxLength(50),
                    TextInput::make('last_name')->label('Last Name')->maxLength(50),
                    TextInput::make('company_name')->label('Company Name')->maxLength(50),
                    TextInput::make('email')->label('Email')->email()->maxLength(100),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    Select::make('currency_id')->label('Currency ID')->relationship('currency', 'currency')->searchable()->preload(),
                    Select::make('timezone_id')->label('Timezone ID')->relationship('timezone', 'timezone_name')->searchable()->preload(),
                    TextInput::make('otp')->label('Otp')->numeric(),
                    TextInput::make('retries')->label('Retries')->numeric(),
                    TextInput::make('client_ip')->label('Client IP')->maxLength(50),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                ]),
        ]);
    }
}
