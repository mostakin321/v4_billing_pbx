<?php

namespace App\Filament\Resources\Astpp\RouteResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RouteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Routes')
                ->columns(3)
                ->schema([
                    TextInput::make('pattern')->label('Pattern')->maxLength(40),
                    Textarea::make('comment')->label('Comment')->rows(3)->columnSpanFull(),
                    TextInput::make('connectcost')->label('Connectcost')->numeric(),
                    TextInput::make('includedseconds')->label('Includedseconds')->numeric(),
                    TextInput::make('cost')->label('Cost')->numeric(),
                    Select::make('pricelist_id')->label('Pricelist ID')->relationship('pricelist', 'name')->searchable()->preload(),
                    TextInput::make('inc')->label('Inc')->numeric(),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    Select::make('call_type')->label('Call Type')->relationship('calltype', 'id')->searchable()->preload(),
                    TextInput::make('routing_type')->label('Routing Type')->maxLength(50),
                    TextInput::make('percentage')->label('Percentage')->maxLength(50),
                    TextInput::make('call_count')->label('Call Count')->numeric(),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('precedence')->label('Precedence')->numeric(),
                    Toggle::make('status')->label('Status'),
                    Select::make('trunk_id')->label('Trunk ID')->relationship('trunk', 'name')->searchable()->preload(),
                    TextInput::make('init_inc')->label('Init Inc')->numeric(),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                ]),
        ]);
    }
}
