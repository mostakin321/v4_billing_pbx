<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PaymentTransactionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Payment Transaction')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('amount')->label('Amount')->numeric(),
                    TextInput::make('tax')->label('Tax')->maxLength(10),
                    TextInput::make('payment_method')->label('Payment Method')->maxLength(20),
                    TextInput::make('actual_amount')->label('Actual Amount')->numeric(),
                    TextInput::make('payment_fee')->label('Payment Fee')->numeric(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('transaction_id')->label('Transaction ID')->maxLength(50),
                    TextInput::make('customer_ip')->label('Customer IP')->maxLength(100),
                    TextInput::make('user_currency')->label('User Currency')->maxLength(50),
                    TextInput::make('currency_rate')->label('Currency Rate')->numeric(),
                    Textarea::make('transaction_details')->label('Transaction Details')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('date')->label('Date'),
                ]),
        ]);
    }
}
