<?php

namespace App\Filament\Resources\Astpp\AccountCalleridResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountCalleridForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Accounts Callerid')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('callerid_name')->label('Callerid Name')->maxLength(30),
                    TextInput::make('callerid_number')->label('Callerid Number')->maxLength(20),
                    Toggle::make('status')->label('Status'),
                ]),
        ]);
    }
}
