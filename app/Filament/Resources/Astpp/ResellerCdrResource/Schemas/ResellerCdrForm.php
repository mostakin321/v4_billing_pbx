<?php

namespace App\Filament\Resources\Astpp\ResellerCdrResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ResellerCdrForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Reseller CDRs')
                ->columns(3)
                ->schema([
                    TextInput::make('uniqueid')->label('Uniqueid')->maxLength(60),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('callerid')->label('Callerid')->maxLength(120),
                    TextInput::make('callednum')->label('Callednum')->maxLength(30),
                    TextInput::make('translated_dst')->label('Translated Dst')->maxLength(30),
                    TextInput::make('billseconds')->label('Billseconds')->numeric(),
                    TextInput::make('disposition')->label('Disposition')->maxLength(45),
                    DateTimePicker::make('callstart')->label('Callstart'),
                    TextInput::make('debit')->label('Debit')->numeric(),
                    TextInput::make('cost')->label('Cost')->numeric(),
                    Select::make('pricelist_id')->label('Pricelist ID')->relationship('pricelist', 'name')->searchable()->preload(),
                    Select::make('package_id')->label('Package ID')->relationship('packageProduct', 'name')->searchable()->preload(),
                    TextInput::make('pattern')->label('Pattern')->maxLength(20),
                    TextInput::make('notes')->label('Notes')->maxLength(80),
                    Select::make('calltype')->label('Calltype')->relationship('calltype', 'id')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('rate_cost')->label('Rate Cost')->numeric(),
                    TextInput::make('reseller_code')->label('Reseller Code')->maxLength(20),
                    TextInput::make('reseller_code_destination')->label('Reseller Code Destination')->maxLength(80),
                    TextInput::make('reseller_cost')->label('Reseller Cost')->numeric(),
                    TextInput::make('call_direction')->label('Call Direction'),
                    TextInput::make('call_request')->label('Call Request')->numeric(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    DateTimePicker::make('end_stamp')->label('End Stamp'),
                    Select::make('trunk_id')->label('Trunk ID')->relationship('trunk', 'name')->searchable()->preload(),
                ]),
        ]);
    }
}
