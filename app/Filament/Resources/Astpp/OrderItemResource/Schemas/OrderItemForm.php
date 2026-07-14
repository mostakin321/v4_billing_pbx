<?php

namespace App\Filament\Resources\Astpp\OrderItemResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Order Items')
                ->columns(3)
                ->schema([
                    Select::make('order_id')->label('Order ID')->relationship('order', 'order_id')->searchable()->preload(),
                    TextInput::make('product_category')->label('Product Category')->numeric(),
                    Select::make('product_id')->label('Product ID')->relationship('product', 'name')->searchable()->preload(),
                    TextInput::make('quantity')->label('Quantity')->numeric(),
                    TextInput::make('price')->label('Price')->numeric(),
                    TextInput::make('setup_fee')->label('Setup Fee')->numeric(),
                    TextInput::make('billing_type')->label('Billing Type')->numeric(),
                    TextInput::make('billing_days')->label('Billing Days')->numeric(),
                    TextInput::make('free_minutes')->label('Free Minutes')->numeric(),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    DateTimePicker::make('billing_date')->label('Billing Date'),
                    DateTimePicker::make('next_billing_date')->label('Next Billing Date'),
                    Toggle::make('is_terminated')->label('Is Terminated'),
                    DateTimePicker::make('termination_date')->label('Termination Date'),
                    TextInput::make('termination_note')->label('Termination Note')->maxLength(255),
                    TextInput::make('from_currency')->label('From Currency')->maxLength(3),
                    TextInput::make('exchange_rate')->label('Exchange Rate')->numeric(),
                    TextInput::make('to_currency')->label('To Currency')->maxLength(3),
                ]),
        ]);
    }
}
