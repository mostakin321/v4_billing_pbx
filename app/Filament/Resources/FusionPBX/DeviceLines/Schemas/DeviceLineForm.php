<?php

namespace App\Filament\Resources\FusionPBX\DeviceLines\Schemas;

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

class DeviceLineForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Device Line')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('line_number')
                        ->label('Line Number')->placeholder('line number'),
                    TextInput::make('server_address')
                        ->label('Server Address')->placeholder('server address'),
                    TextInput::make('server_address_primary')
                        ->label('Server Address Primary')->placeholder('server address primary'),
                    TextInput::make('server_address_secondary')
                        ->label('Server Address Secondary')->placeholder('server address secondary'),
                    TextInput::make('label')
                        ->label('Label')->placeholder('label'),
                    TextInput::make('display_name')
                        ->label('Display Name')->placeholder('display name'),
                    TextInput::make('user_id')
                        ->label('User Id')->placeholder('user id'),
                    TextInput::make('password')
                        ->label('Password')
                        ->password()->revealable(),
                    TextInput::make('shared_line')
                        ->label('Shared Line')->placeholder('shared line'),
                    Select::make('enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Enabled','false'=>'Disabled'])->default('true'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('outbound_proxy_primary')
                        ->label('Outbound Proxy Primary')->placeholder('outbound proxy primary'),
                    TextInput::make('outbound_proxy_secondary')
                        ->label('Outbound Proxy Secondary')->placeholder('outbound proxy secondary'),
                    TextInput::make('auth_id')
                        ->label('Auth Id')->placeholder('auth id'),
                    TextInput::make('sip_port')
                        ->label('Sip Port')->placeholder('sip port'),
                    Select::make('sip_transport')
                        ->label('Sip Transport')
                        ->options(['udp'=>'UDP','tcp'=>'TCP','tls'=>'TLS','wss'=>'WSS'])
                        ->default('udp')->native(false),
                    TextInput::make('register_expires')
                        ->label('Register Expires')
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
