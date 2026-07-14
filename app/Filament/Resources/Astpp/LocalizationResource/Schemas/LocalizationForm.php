<?php

namespace App\Filament\Resources\Astpp\LocalizationResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LocalizationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Localization')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(50),
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    TextInput::make('in_caller_id_originate')->label('In Caller ID Originate')->maxLength(200),
                    TextInput::make('out_caller_id_originate')->label('Out Caller ID Originate')->maxLength(200),
                    TextInput::make('number_originate')->label('Number Originate')->maxLength(200),
                    TextInput::make('in_caller_id_terminate')->label('In Caller ID Terminate')->maxLength(200),
                    TextInput::make('out_caller_id_terminate')->label('Out Caller ID Terminate')->maxLength(200),
                    TextInput::make('number_terminate')->label('Number Terminate')->maxLength(200),
                    Toggle::make('status')->label('Status'),
                    Toggle::make('type')->label('Type'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('modified_date')->label('Modified Date'),
                    TextInput::make('dst_base_cid')->label('Dst Base Cid')->maxLength(200),
                    TextInput::make('custom_rule')->label('Custom Rule')->maxLength(200),
                ]),
        ]);
    }
}
