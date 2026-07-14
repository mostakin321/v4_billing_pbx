<?php

namespace App\Filament\Resources\FusionPBX\Gateways\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Tabs;

use Illuminate\Support\HtmlString;

class GatewayForm
{
    public static function configure(\Filament\Schemas\Schema $form): \Filament\Schemas\Schema
    {
        return $form->schema([

            Tabs::make('Gateway')->columnSpanFull()->tabs([

                Tabs\Tab::make('Main')->icon('heroicon-o-globe-alt')->schema([
                    Section::make('Gateway Identity')->columns(2)->schema([
                        TextInput::make('gateway')->label('Gateway')->required()->placeholder('my-gateway'),
                        Select::make('enabled')->label('Enabled')->options(['true'=>'True','false'=>'False'])->default('true')->native(false),
                        TextInput::make('username')->label('Username')->placeholder('sip-user'),
                        TextInput::make('password')->label('Password')->password()->revealable(),
                        TextInput::make('from_user')->label('From User')->placeholder('from-user'),
                        TextInput::make('from_domain')->label('From Domain')->placeholder('sip.provider.com'),
                        TextInput::make('proxy')->label('Proxy')->required()->placeholder('host[:port]'),
                        TextInput::make('realm')->label('Realm')->placeholder('sip.provider.com'),
                        TextInput::make('expire_seconds')->label('Expire Seconds')->numeric()->default(3600),
                        Select::make('register')->label('Register')->options(['true'=>'True','false'=>'False'])->default('true')->native(false),
                        TextInput::make('retry_seconds')->label('Retry Seconds')->numeric()->default(30),
                        Select::make('context')->label('Context')->options([])->default('public')
                            ->searchable()->createOptionForm([])->placeholder('public'),
                        TextInput::make('context')->label('Context')->default('public'),
                        Select::make('profile')->label('Profile')->options(['external'=>'External','internal'=>'Internal'])->default('external')->native(false),
                        TextInput::make('description')->label('Description')->placeholder('description'),
                    ]),
                ]),

                Tabs\Tab::make('Advanced')->icon('heroicon-o-cog-6-tooth')->schema([
                    Section::make('Advanced Settings')->columns(3)->schema([
                        Select::make('distinct_to')->label('Distinct To')->options(['true'=>'True','false'=>'False'])->default('false')->native(false),
                        TextInput::make('auth_username')->label('Auth Username'),
                        TextInput::make('extension')->label('Extension'),
                        Select::make('register_transport')->label('Register Transport')->options(['udp'=>'UDP','tcp'=>'TCP','tls'=>'TLS','wss'=>'WSS'])->default('udp')->native(false),
                        TextInput::make('contact_params')->label('Contact Params'),
                        TextInput::make('register_proxy')->label('Register Proxy'),
                        TextInput::make('outbound_proxy')->label('Outbound Proxy'),
                        Select::make('caller_id_in_from')->label('Caller ID in From')->options(['true'=>'True','false'=>'False'])->default('false')->native(false),
                        Select::make('supress_cng')->label('Suppress CNG')->options(['true'=>'True','false'=>'False'])->default('false')->native(false),
                        TextInput::make('sip_cid_type')->label('SIP CID Type')->placeholder('none|pid|rpid'),
                        TextInput::make('codec_prefs')->label('Codec Prefs')->placeholder('PCMU,PCMA,G729'),
                        Select::make('extension_in_contact')->label('Extension in Contact')->options(['true'=>'True','false'=>'False'])->default('false')->native(false),
                        TextInput::make('ping')->label('Ping (sec)')->numeric(),
                        TextInput::make('ping_min')->label('Ping Min')->numeric(),
                        TextInput::make('ping_max')->label('Ping Max')->numeric(),
                        Select::make('contact_in_ping')->label('Contact in Ping')->options(['true'=>'True','false'=>'False'])->default('false')->native(false),
                        TextInput::make('channels')->label('Max Channels')->numeric(),
                        TextInput::make('hostname')->label('Hostname'),
                    ]),
                ]),
            ]),

            Section::make('Record Info')->description('System identifiers — read only.')->icon('heroicon-o-information-circle')->collapsed()->columns(3)->schema([
                Placeholder::make('gateway_uuid')->label('UUID')
                    ->content(fn ($record) => $record?->gateway_uuid
                        ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->gateway_uuid.'</code>')
                        : 'Assigned on save'),
                Placeholder::make('insert_date')->label('Created')
                    ->content(fn ($record) => $record?->insert_date ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                Placeholder::make('update_date')->label('Last Updated')
                    ->content(fn ($record) => $record?->update_date ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
            ])->visibleOn('edit'),
        ]);
    }
}
