<?php

namespace App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AccountsCdrSummaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Accounts CDR Summary')
                ->columns(3)
                ->schema([
                    DateTimePicker::make('date_hour')->label('Date Hour'),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    TextInput::make('account_entity_id')->label('Account Entity ID')->numeric(),
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('total_calls')->label('Total Calls')->numeric(),
                    TextInput::make('answered_calls')->label('Answered Calls')->numeric(),
                    TextInput::make('minutes')->label('Minutes')->numeric(),
                    TextInput::make('debit')->label('Debit')->numeric(),
                    TextInput::make('cost')->label('Cost')->numeric(),
                    TextInput::make('acd')->label('Acd')->maxLength(50),
                ]),
        ]);
    }
}
