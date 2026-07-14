<?php

namespace App\Filament\Resources\Astpp\AddonResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AddonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Addons')
                ->columns(3)
                ->schema([
                    TextInput::make('package_name')->label('Package Name')->maxLength(30),
                    TextInput::make('version')->label('Version')->maxLength(10),
                    DateTimePicker::make('installed_date')->label('Installed Date'),
                    DateTimePicker::make('last_updated_date')->label('Last Updated Date'),
                    Textarea::make('files')->label('Files')->rows(3)->columnSpanFull(),
                ]),
        ]);
    }
}
