<?php

namespace App\Filament\Resources\Astpp\CiSessionResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CiSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Ci Sessions')
                ->columns(3)
                ->schema([
                    TextInput::make('session_id')->label('Session ID')->maxLength(40),
                    TextInput::make('ip_address')->label('IP Address')->maxLength(16),
                    TextInput::make('user_agent')->label('User Agent')->maxLength(150),
                    TextInput::make('last_activity')->label('Last Activity')->numeric(),
                    Textarea::make('user_data')->label('User Data')->rows(3)->columnSpanFull(),
                ]),
        ]);
    }
}
