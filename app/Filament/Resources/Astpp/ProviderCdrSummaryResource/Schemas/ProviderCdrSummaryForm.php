<?php

namespace App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProviderCdrSummaryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Provider CDR Summary')
                ->columns(3)
                ->schema([
                    TextInput::make('date_hour')->label('Date Hour')->maxLength(25),
                    Select::make('country_id')->label('Country ID')->relationship('country', 'country')->searchable()->preload(),
                    Select::make('provider_id')->label('Provider ID')->relationship('provider', 'number')->searchable()->preload(),
                    Select::make('trunk_id')->label('Trunk ID')->relationship('trunk', 'name')->searchable()->preload(),
                    TextInput::make('total_calls')->label('Total Calls')->numeric(),
                    TextInput::make('answered_calls')->label('Answered Calls')->numeric(),
                    TextInput::make('minutes')->label('Minutes')->maxLength(50),
                    TextInput::make('cost')->label('Cost')->numeric(),
                ]),
        ]);
    }
}
