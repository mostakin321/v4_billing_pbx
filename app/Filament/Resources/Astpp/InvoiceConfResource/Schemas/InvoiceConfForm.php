<?php

namespace App\Filament\Resources\Astpp\InvoiceConfResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InvoiceConfForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Invoice Conf')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('company_name')->label('Company Name')->maxLength(100),
                    TextInput::make('address')->label('Address')->maxLength(300),
                    TextInput::make('city')->label('City')->maxLength(20),
                    TextInput::make('province')->label('Province')->maxLength(20),
                    TextInput::make('country')->label('Country')->maxLength(20),
                    TextInput::make('zipcode')->label('Zipcode')->maxLength(10),
                    TextInput::make('telephone')->label('Telephone')->maxLength(20),
                    TextInput::make('fax')->label('Fax')->maxLength(20),
                    TextInput::make('emailaddress')->label('Emailaddress')->maxLength(100),
                    TextInput::make('website')->label('Website')->maxLength(100),
                    TextInput::make('invoice_prefix')->label('Invoice Prefix')->maxLength(11),
                    TextInput::make('invoice_start_from')->label('Invoice Start From')->numeric(),
                    TextInput::make('logo')->label('Logo')->maxLength(100),
                    TextInput::make('favicon')->label('Favicon')->maxLength(100),
                    Textarea::make('invoice_note')->label('Invoice Note')->rows(3)->columnSpanFull(),
                    Toggle::make('invoice_due_notification')->label('Invoice Due Notification'),
                    Toggle::make('invoice_notification')->label('Invoice Notification'),
                    TextInput::make('no_usage_invoice')->label('No Usage Invoice')->numeric(),
                    TextInput::make('interval')->label('Interval')->maxLength(11),
                    TextInput::make('notify_before_day')->label('Notify Before Day')->numeric(),
                    TextInput::make('invoice_taxes_number')->label('Invoice Taxes Number')->maxLength(100),
                    TextInput::make('domain')->label('Domain')->maxLength(100),
                    TextInput::make('website_title')->label('Website Title')->maxLength(100),
                    TextInput::make('website_footer')->label('Website Footer')->maxLength(100),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                ]),
        ]);
    }
}
