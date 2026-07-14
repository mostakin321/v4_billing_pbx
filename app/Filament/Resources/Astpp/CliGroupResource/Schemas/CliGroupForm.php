<?php

namespace App\Filament\Resources\Astpp\CliGroupResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CliGroupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Cli Group')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(20),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('mapping_expired_by')->label('Mapping Expired By')->maxLength(5),
                    TextInput::make('mapping_expired_after')->label('Mapping Expired After')->maxLength(5),
                    Toggle::make('assignment_method')->label('Assignment Method'),
                    Toggle::make('status')->label('Status'),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                    DateTimePicker::make('last_access_date')->label('Last Access Date'),
                ]),
        ]);
    }
}
