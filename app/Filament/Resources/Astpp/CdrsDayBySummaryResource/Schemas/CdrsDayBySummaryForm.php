<?php

namespace App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CdrsDayBySummaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('CDRs Day By Summary')
                ->columns(3)
                ->schema([
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('type')->label('Type')->numeric(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    TextInput::make('billseconds')->label('Billseconds')->numeric(),
                    TextInput::make('mcd')->label('Mcd')->numeric(),
                    TextInput::make('total_calls')->label('Total Calls')->numeric(),
                    TextInput::make('debit')->label('Debit')->numeric(),
                    TextInput::make('cost')->label('Cost')->numeric(),
                    TextInput::make('total_answered_call')->label('Total Answered Call')->numeric(),
                    TextInput::make('total_fail_call')->label('Total Fail Call')->numeric(),
                    TextInput::make('unique_date')->label('Unique Date')->maxLength(50),
                    DateTimePicker::make('calldate')->label('Calldate'),
                ]),
        ]);
    }
}
