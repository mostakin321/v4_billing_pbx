<?php

namespace App\Filament\Resources\Astpp\DefaultTemplateResource\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DefaultTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Default Templates')
                ->columns(3)
                ->schema([
                    TextInput::make('name')->label('Name')->maxLength(45),
                    TextInput::make('subject')->label('Subject')->maxLength(500),
                    Textarea::make('description')->label('Description')->rows(3)->columnSpanFull(),
                    TextInput::make('sms_template')->label('Sms Template')->maxLength(500),
                    TextInput::make('alert_template')->label('Alert Template')->maxLength(500),
                    Textarea::make('template')->label('Template')->rows(3)->columnSpanFull(),
                    DateTimePicker::make('last_modified_date')->label('Last Modified Date'),
                    Select::make('reseller_id')->label('Reseller ID')->relationship('reseller', 'number')->searchable()->preload(),
                    Toggle::make('is_email_enable')->label('Is Email Enable'),
                    Toggle::make('is_sms_enable')->label('Is Sms Enable'),
                    Toggle::make('is_alert_enable')->label('Is Alert Enable'),
                    Toggle::make('status')->label('Status'),
                ]),
        ]);
    }
}
