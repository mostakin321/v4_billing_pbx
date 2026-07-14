<?php

namespace App\Filament\Resources\Astpp\ResellerProductResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ResellerProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Reseller Products')
                ->columns(3)
                ->schema([
                    Select::make('product_id')->label('Product ID')->relationship('product', 'name')->searchable()->preload(),
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    TextInput::make('status')->label('Status')->numeric(),
                    TextInput::make('buy_cost')->label('Buy Cost')->numeric(),
                    TextInput::make('price')->label('Price')->numeric(),
                    TextInput::make('free_minutes')->label('Free Minutes')->numeric(),
                    TextInput::make('commission')->label('Commission')->numeric(),
                    TextInput::make('setup_fee')->label('Setup Fee')->numeric(),
                    TextInput::make('billing_days')->label('Billing Days')->numeric(),
                    TextInput::make('billing_type')->label('Billing Type')->numeric(),
                    TextInput::make('is_owner')->label('Is Owner')->numeric(),
                    TextInput::make('is_optin')->label('Is Optin')->numeric(),
                    DateTimePicker::make('optin_date')->label('Optin Date'),
                    DateTimePicker::make('modified_date')->label('Modified Date'),
                ]),
        ]);
    }
}
