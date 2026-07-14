<?php

namespace App\Filament\Resources\Astpp\SipProfileResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SipProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('SIP Profiles')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(20),
                    TextInput::make('sip_ip')->label('SIP IP')->maxLength(39),
                    TextInput::make('sip_port')->label('SIP Port')->maxLength(6),
                    Textarea::make('profile_data')->label('Profile Data')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('created_date')->label('Created Date'),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    Toggle::make('status')->label('Status'),
                ]),
        ]);
    }
}
