<?php

namespace App\Filament\Resources\FusionPBX\UserLogs\Schemas;

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

class UserLogForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('User Log')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('DATETIME')
                        ->label('Datetime')->placeholder('datetime'),
                    TextInput::make('username')
                        ->label('Username')->placeholder('username'),
                    TextInput::make('type')
                        ->label('Type')->placeholder('type'),
                    TextInput::make('result')
                        ->label('Result')->placeholder('result'),
                    TextInput::make('remote_address')
                        ->label('Remote Address')->placeholder('remote address'),
                    TextInput::make('user_agent')
                        ->label('User Agent')->placeholder('user agent'),
                    TextInput::make('session_id')
                        ->label('Session Id')->placeholder('session id'),
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
