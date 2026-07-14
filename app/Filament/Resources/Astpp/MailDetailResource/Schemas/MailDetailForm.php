<?php

namespace App\Filament\Resources\Astpp\MailDetailResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class MailDetailForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Mail Details')
                ->columns(3)
                ->schema([
                    Select::make('accountid')->label('Accountid')->relationship('account', 'number')->searchable()->preload(),
                    DateTimePicker::make('date')->label('Date'),
                    TextInput::make('subject')->label('Subject')->maxLength(100),
                    Textarea::make('body')->label('Body')->rows(3)->columnSpanFull(),
                    TextInput::make('from')->label('From')->maxLength(100),
                    TextInput::make('to')->label('To')->maxLength(100),
                    TextInput::make('attachment')->label('Attachment')->maxLength(100),
                    Toggle::make('status')->label('Status'),
                    Textarea::make('template')->label('Template')->rows(3)->columnSpanFull(),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    TextInput::make('to_number')->label('To Number')->maxLength(20),
                    TextInput::make('sms_body')->label('Sms Body')->maxLength(500),
                    TextInput::make('sip_user_name')->label('SIP User Name')->maxLength(255),
                    TextInput::make('push_message_body')->label('Push Message Body')->maxLength(555),
                    TextInput::make('callkit_token')->label('Callkit Token')->maxLength(512),
                    TextInput::make('status_code')->label('Status Code')->numeric(),
                    TextInput::make('cc')->label('Cc')->maxLength(255),
                ]),
        ]);
    }
}
