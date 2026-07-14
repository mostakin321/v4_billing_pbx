<?php

namespace App\Filament\Resources\Astpp\RefillCouponResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RefillCouponForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Refill Coupon')
                ->columns(3)
                ->schema([
                    TextInput::make('number')->label('Number')->maxLength(30),
                    TextInput::make('amount')->label('Amount')->numeric(),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    Toggle::make('status')->label('Status'),
                    DateTimePicker::make('firstused')->label('Firstused'),
                    Select::make('account_id')->label('Account ID')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Select::make('currency_id')->label('Currency ID')->relationship('currency', 'currency')->searchable()->preload(),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                ]),
        ]);
    }
}
