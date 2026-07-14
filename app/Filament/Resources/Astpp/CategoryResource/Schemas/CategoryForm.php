<?php

namespace App\Filament\Resources\Astpp\CategoryResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Category')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(100),
                    TextInput::make('code')->label('Code')->maxLength(50),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('status')->label('Status')->numeric(),
                    DateTimePicker::make('creation_date')->label('Creation Date'),
                ]),
        ]);
    }
}
