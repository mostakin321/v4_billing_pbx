<?php

namespace App\Filament\Resources\FusionPBX\VoicemailMessages\Schemas;

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

class VoicemailMessageForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Voicemail Message')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('created_epoch')
                        ->label('Created Epoch')->placeholder('created epoch'),
                    TextInput::make('read_epoch')
                        ->label('Read Epoch')->placeholder('read epoch'),
                    TextInput::make('message_length')
                        ->label('Message Length')->placeholder('message length'),
                    TextInput::make('message_status')
                        ->label('Message Status')->placeholder('message status'),
                    TextInput::make('message_priority')
                        ->label('Message Priority')->placeholder('message priority'),
                    TextInput::make('message_intro_base64')
                        ->label('Message Intro Base64')->placeholder('message intro base64'),
                    TextInput::make('message_base64')
                        ->label('Message Base64')->placeholder('message base64'),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('caller_id_name')
                        ->label('Caller Id Name')->placeholder('caller id name'),
                    TextInput::make('caller_id_number')
                        ->label('Caller Id Number')->placeholder('caller id number'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    Select::make('message_transcription')
                        ->label('Message Transcription')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
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
