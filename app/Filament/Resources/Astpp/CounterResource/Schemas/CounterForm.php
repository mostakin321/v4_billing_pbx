<?php

namespace App\Filament\Resources\Astpp\CounterResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CounterForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Counters')
                ->columns(3)
                ->schema([
                    Select::make('product_id')->label('Product ID')->relationship('product', 'name')->searchable()->preload(),
                    Select::make('package_id')->label('Package ID')->relationship('packageProduct', 'name')->searchable()->preload(),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('used_seconds')->label('Used Seconds')->numeric(),
                    Toggle::make('type')->label('Type'),
                    Toggle::make('status')->label('Status'),
                ]),
        ]);
    }
}
