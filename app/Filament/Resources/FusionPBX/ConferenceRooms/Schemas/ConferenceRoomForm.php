<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRooms\Schemas;

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

class ConferenceRoomForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Conference Room')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_room_name')
                        ->label('Room Name')->placeholder('room name'),
                    TextInput::make('profile')
                        ->label('Profile')->placeholder('profile'),
                    TextInput::make('record')
                        ->label('Record')->placeholder('record'),
                    TextInput::make('moderator_pin')
                        ->label('Moderator Pin')
                        ->password()->revealable()->numeric(),
                    TextInput::make('participant_pin')
                        ->label('Participant Pin')
                        ->password()->revealable()->numeric(),
                    TextInput::make('start_datetime')
                        ->label('Start Datetime')->placeholder('start datetime'),
                    TextInput::make('stop_datetime')
                        ->label('Stop Datetime')->placeholder('stop datetime'),
                    TextInput::make('wait_mod')
                        ->label('Wait Mod')->placeholder('wait mod'),
                    TextInput::make('moderator_endconf')
                        ->label('Moderator Endconf')->placeholder('moderator endconf'),
                    TextInput::make('announce_name')
                        ->label('Announce Name')->placeholder('announce name'),
                    TextInput::make('announce_count')
                        ->label('Announce Count')->placeholder('announce count'),
                    TextInput::make('mute')
                        ->label('Mute')->placeholder('mute'),
                    TextInput::make('created')
                        ->label('Created')->placeholder('created'),
                    TextInput::make('created_by')
                        ->label('Created By')->placeholder('created by'),
                    TextInput::make('account_code')
                        ->label('Account Code')->placeholder('account code'),
                    Select::make('enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Enabled','false'=>'Disabled'])->default('true'),
                    Textarea::make('description')
                        ->label('Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('announce_recording')
                        ->label('Announce Recording')->placeholder('announce recording'),
                    TextInput::make('sounds')
                        ->label('Sounds')->placeholder('path/to/file.wav'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('email_address')
                        ->label('Email Address')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('max_members')
                        ->label('Max Members')
                        ->numeric(),
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
