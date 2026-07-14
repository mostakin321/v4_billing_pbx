<?php

namespace App\Filament\Resources\FusionPBX\Voicemails\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class VoicemailForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Voicemail')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('voicemail_password')
                        ->label('Password')
                        ->password()->revealable(),
                    Select::make('voicemail_transcription_enabled')
                        ->label('Transcription Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Select::make('voicemail_enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('voicemail_description')
                        ->label('Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('greeting_id')
                        ->label('Greeting Id')->placeholder('path/to/file.wav'),
                    TextInput::make('voicemail_alternate_greet_id')
                        ->label('Alternate Greet Id')->placeholder('path/to/file.wav'),
                    TextInput::make('voicemail_recording_instructions')
                        ->label('Instructions')->placeholder('instructions'),
                    TextInput::make('voicemail_recording_options')
                        ->label('Options')->placeholder('options'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('voicemail_id')
                        ->label('Id')->email(),
                    TextInput::make('voicemail_mail_to')
                        ->label('Mail To')->email()->placeholder('user@example.com'),
                    TextInput::make('voicemail_sms_to')
                        ->label('Sms To')->placeholder('+15551234567'),
                    TextInput::make('voicemail_attach_file')
                        ->label('Attach File')->email(),
                    TextInput::make('voicemail_file')
                        ->label('File')->email(),
                    TextInput::make('voicemail_local_after_email')
                        ->label('Local After Email')->email(),
                    TextInput::make('voicemail_local_after_forward')
                        ->label('Local After Forward')->email(),
                    TextInput::make('voicemail_name_base64')
                        ->label('Name Base64')->email(),
                    TextInput::make('voicemail_tutorial')
                        ->label('Tutorial')->email(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('domain_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->domain_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->domain_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
