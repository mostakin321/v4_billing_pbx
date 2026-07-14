<?php

namespace App\Filament\Resources\Astpp\InvoiceDetailResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InvoiceDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Invoice Details')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Select::make('invoiceid')->label('Invoiceid')->relationship('invoice', 'number')->searchable()->preload(),
                    Select::make('order_item_id')->label('Order Item ID')->relationship('orderItem', 'order_id')->searchable()->preload(),
                    TextInput::make('charge_type')->label('Charge Type')->maxLength(30),
                    Select::make('payment_id')->label('Payment ID')->relationship('paymentTransaction', 'id')->searchable()->preload(),
                    TextInput::make('product_category')->label('Product Category')->numeric(),
                    Toggle::make('is_tax')->label('Is Tax'),
                    TextInput::make('base_currency')->label('Base Currency')->maxLength(5),
                    TextInput::make('exchange_rate')->label('Exchange Rate')->numeric(),
                    TextInput::make('account_currency')->label('Account Currency')->maxLength(5),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('debit')->label('Debit')->numeric(),
                    TextInput::make('credit')->label('Credit')->numeric(),
                    DateTimePicker::make('created_date')->label('Created Date'),
                    TextInput::make('generate_type')->label('Generate Type')->numeric(),
                    TextInput::make('before_balance')->label('Before Balance')->maxLength(100),
                    TextInput::make('after_balance')->label('After Balance')->maxLength(100),
                    TextInput::make('quantity')->label('Quantity')->numeric(),
                ]),
        ]);
    }
}
