<?php

namespace App\Filament\Resources\Astpp\ActivityReportResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ActivityReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Activity Reports')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    DateTimePicker::make('last_did_call_time')->label('Last Did Call Time'),
                    DateTimePicker::make('last_outbound_call_time')->label('Last Outbound Call Time'),
                    TextInput::make('balance')->label('Balance')->maxLength(40),
                    TextInput::make('credit_limit')->label('Credit Limit')->maxLength(40),
                ]),
        ]);
    }
}
