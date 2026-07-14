<?php

namespace App\Filament\Resources\Astpp\TaxesToAccountResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TaxesToAccountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Taxes To Accounts')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('taxes_id')->label('Taxes ID')->relationship('tax', 'id')->searchable()->preload(),
                    TextInput::make('taxes_priority')->label('Taxes Priority')->numeric(),
                    DateTimePicker::make('assign_date')->label('Assign Date'),
                ]),
        ]);
    }
}
