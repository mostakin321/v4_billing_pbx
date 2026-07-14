<?php

namespace App\Filament\Resources\Astpp\TaxeResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TaxeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Taxes')
                ->columns(3)
                ->schema([
                    TextInput::make('taxes_priority')->label('Taxes Priority')->numeric(),
                    TextInput::make('taxes_amount')->label('Taxes Amount')->numeric(),
                    Toggle::make('tax_type')->label('Tax Type'),
                    TextInput::make('taxes_rate')->label('Taxes Rate')->numeric(),
                    TextInput::make('taxes_description')->label('Taxes Description')->maxLength(255),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    Toggle::make('status')->label('Status'),
                ]),
        ]);
    }
}
