<?php

namespace App\Filament\Resources\FusionPBX\DeviceLogs\Schemas;

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

class DeviceLogForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Device Log')
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
                    TextInput::make('device_address')
                        ->label('Address')->placeholder('address'),
                    TextInput::make('request_scheme')
                        ->label('Request Scheme')->placeholder('request scheme'),
                    TextInput::make('http_host')
                        ->label('Http Host')->placeholder('http host'),
                    TextInput::make('server_port')
                        ->label('Server Port')->placeholder('server port'),
                    TextInput::make('server_protocol')
                        ->label('Server Protocol')->placeholder('server protocol'),
                    TextInput::make('query_string')
                        ->label('Query String')->placeholder('query string'),
                    TextInput::make('remote_address')
                        ->label('Remote Address')->placeholder('remote address'),
                    TextInput::make('http_user_agent')
                        ->label('Http User Agent')->placeholder('http user agent'),
                    TextInput::make('http_status')
                        ->label('Http Status')->placeholder('http status'),
                    TextInput::make('http_status_code')
                        ->label('Http Status Code')->placeholder('http status code'),
                    TextInput::make('http_content_body')
                        ->label('Http Content Body')->placeholder('http content body'),
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
