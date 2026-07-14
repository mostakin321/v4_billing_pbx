<?php

namespace App\Filament\Resources\Astpp\BlockPatternResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BlockPatternForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Block Patterns')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    TextInput::make('blocked_patterns')->label('Blocked Patterns')->maxLength(15),
                    TextInput::make('destination')->label('Destination')->maxLength(100),
                ]),
        ]);
    }
}
