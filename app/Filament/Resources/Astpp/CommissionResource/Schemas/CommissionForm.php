<?php

namespace App\Filament\Resources\Astpp\CommissionResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Commission')
                ->columns(3)
                ->schema([
                    Select::make('product_id')->label('Product ID')->relationship('product', 'name')->searchable()->preload(),
                    Select::make('order_id')->label('Order ID')->relationship('order', 'order_id')->searchable()->preload(),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Select::make('payment_id')->label('Payment ID')->relationship('paymentTransaction', 'id')->searchable()->preload(),
                    TextInput::make('amount')->label('Amount')->numeric(),
                    TextInput::make('commission')->label('Commission')->numeric(),
                    TextInput::make('commission_rate')->label('Commission Rate')->numeric(),
                    TextInput::make('commission_status')->label('Commission Status')->maxLength(10),
                    TextInput::make('notes')->label('Notes')->maxLength(255),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                ]),
        ]);
    }
}
