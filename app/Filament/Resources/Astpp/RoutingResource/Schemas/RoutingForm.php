<?php

namespace App\Filament\Resources\Astpp\RoutingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoutingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Routing')
                ->columns(3)
                ->schema([
                    Select::make('pricelist_id')->label('Pricelist ID')->relationship('pricelist', 'name')->searchable()->preload(),
                    Select::make('trunk_id')->label('Trunk ID')->relationship('trunk', 'name')->searchable()->preload(),
                    Select::make('routes_id')->label('Routes ID')->relationship('route', 'pattern')->searchable()->preload(),
                    TextInput::make('percentage')->label('Percentage')->maxLength(20),
                    TextInput::make('call_count')->label('Call Count')->numeric(),
                ]),
        ]);
    }
}
