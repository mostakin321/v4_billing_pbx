<?php

namespace App\Filament\Resources\Astpp\CdrsStagingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CdrsStagingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('CDRs Staging')
                ->columns(3)
                ->schema([
                    TextInput::make('uniqueid')->label('Uniqueid')->maxLength(60),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Toggle::make('type')->label('Type'),
                    TextInput::make('sip_user')->label('SIP User')->maxLength(20),
                    TextInput::make('callerid')->label('Callerid')->maxLength(120),
                    TextInput::make('callednum')->label('Callednum')->maxLength(30),
                    TextInput::make('translated_dst')->label('Translated Dst')->maxLength(30),
                    TextInput::make('ct')->label('Ct')->numeric(),
                    TextInput::make('billseconds')->label('Billseconds')->numeric(),
                    Select::make('trunk_id')->label('Trunk ID')->relationship('trunk', 'name')->searchable()->preload(),
                    TextInput::make('trunkip')->label('Trunkip')->maxLength(15),
                    TextInput::make('callerip')->label('Callerip')->maxLength(15),
                    TextInput::make('disposition')->label('Disposition')->maxLength(45),
                    DateTimePicker::make('callstart')->label('Callstart'),
                    TextInput::make('debit')->label('Debit')->numeric(),
                    TextInput::make('cost')->label('Cost')->numeric(),
                    Select::make('provider_id')->label('Provider ID')->relationship('provider', 'number')->searchable()->preload(),
                    Select::make('pricelist_id')->label('Pricelist ID')->relationship('pricelist', 'name')->searchable()->preload(),
                    Select::make('package_id')->label('Package ID')->relationship('packageProduct', 'name')->searchable()->preload(),
                    TextInput::make('pattern')->label('Pattern')->maxLength(20),
                    TextInput::make('notes')->label('Notes')->maxLength(80),
                    Select::make('invoiceid')->label('Invoiceid')->relationship('invoice', 'number')->searchable()->preload(),
                    TextInput::make('rate_cost')->label('Rate Cost')->numeric(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('reseller_code')->label('Reseller Code')->maxLength(20),
                    TextInput::make('reseller_code_destination')->label('Reseller Code Destination')->maxLength(80),
                    TextInput::make('reseller_cost')->label('Reseller Cost')->numeric(),
                    TextInput::make('provider_code')->label('Provider Code')->maxLength(20),
                    TextInput::make('provider_code_destination')->label('Provider Code Destination')->maxLength(80),
                    TextInput::make('provider_cost')->label('Provider Cost')->numeric(),
                    TextInput::make('provider_call_cost')->label('Provider Call Cost')->numeric(),
                    TextInput::make('call_direction')->label('Call Direction'),
                    Select::make('calltype')->label('Calltype')->relationship('calltype', 'id')->searchable()->preload(),
                    TextInput::make('billmsec')->label('Billmsec')->numeric(),
                    TextInput::make('answermsec')->label('Answermsec')->numeric(),
                    TextInput::make('waitmsec')->label('Waitmsec')->numeric(),
                    TextInput::make('progress_mediamsec')->label('Progress Mediamsec')->numeric(),
                    TextInput::make('flow_billmsec')->label('Flow Billmsec')->numeric(),
                    Toggle::make('is_recording')->label('Is Recording'),
                    TextInput::make('call_request')->label('Call Request')->numeric(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    DateTimePicker::make('end_stamp')->label('End Stamp'),
                ]),
        ]);
    }
}
