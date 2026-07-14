<?php

namespace App\Filament\Resources\Astpp\UsertrackingResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UsertrackingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Usertracking')
                ->columns(3)
                ->schema([
                    TextInput::make('session_id')->label('Session ID')->maxLength(100),
                    TextInput::make('user_identifier')->label('User IDentifier')->maxLength(255),
                    Textarea::make('request_uri')->label('Request Uri')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('timestamp')->label('Timestamp'),
                    TextInput::make('client_ip')->label('Client IP')->maxLength(50),
                    Textarea::make('client_user_agent')->label('Client User Agent')->rows(3)->columnSpanFull(),
                    Textarea::make('referer_page')->label('Referer Page')->rows(3)->columnSpanFull(),
                ]),
        ]);
    }
}
