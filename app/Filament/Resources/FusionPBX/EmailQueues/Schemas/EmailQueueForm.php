<?php

namespace App\Filament\Resources\FusionPBX\EmailQueues\Schemas;

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

class EmailQueueForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Email Queue')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('email_date')
                        ->label('Email Date')->email(),
                    TextInput::make('email_from')
                        ->label('Email From')->email(),
                    TextInput::make('email_to')
                        ->label('Email To')->email()->placeholder('user@example.com'),
                    TextInput::make('email_subject')
                        ->label('Email Subject')->email(),
                    TextInput::make('email_body')
                        ->label('Email Body')->email(),
                    TextInput::make('email_status')
                        ->label('Email Status')->email(),
                    TextInput::make('email_retry_count')
                        ->label('Email Retry Count')->email(),
                    TextInput::make('email_action_before')
                        ->label('Email Action Before')->email(),
                    TextInput::make('email_action_after')
                        ->label('Email Action After')->email(),
                    TextInput::make('email_transcription')
                        ->label('Email Transcription')->email(),
                    TextInput::make('email_response')
                        ->label('Email Response')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('hostname')
                        ->label('Hostname')->placeholder('e.g. pbx.example.com'),
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
