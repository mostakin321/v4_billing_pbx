<?php

namespace App\Filament\Resources\FusionPBX\Faxes\Schemas;

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

class FaxForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Fax')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_extension')
                        ->label('Fax Extension')->placeholder('fax extension'),
                    TextInput::make('fax_destination_number')
                        ->label('Fax Destination Number')->placeholder('fax destination number'),
                    TextInput::make('fax_prefix')
                        ->label('Fax Prefix')->placeholder('fax prefix'),
                    TextInput::make('fax_name')
                        ->label('Fax Name')->placeholder('fax name'),
                    TextInput::make('fax_file')
                        ->label('Fax File')->placeholder('fax file'),
                    TextInput::make('fax_email_connection_password')
                        ->label('Fax Email Connection Password')
                        ->password()->revealable(),
                    TextInput::make('fax_pin_number')
                        ->label('Fax Pin Number')
                        ->password()->revealable()->numeric(),
                    TextInput::make('fax_toll_allow')
                        ->label('Fax Toll Allow')->placeholder('fax toll allow'),
                    TextInput::make('fax_forward_number')
                        ->label('Fax Forward Number')->placeholder('fax forward number'),
                    Textarea::make('fax_description')
                        ->label('Fax Description')->rows(2)->columnSpanFull(),
                    TextInput::make('accountcode')
                        ->label('Accountcode')->placeholder('accountcode'),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_caller_id_name')
                        ->label('Fax Caller Id Name')->placeholder('fax caller id name'),
                    TextInput::make('fax_caller_id_number')
                        ->label('Fax Caller Id Number')->placeholder('fax caller id number'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_email')
                        ->label('Fax Email')->email(),
                    TextInput::make('fax_email_confirmation')
                        ->label('Fax Email Confirmation')->email(),
                    TextInput::make('fax_email_connection_type')
                        ->label('Fax Email Connection Type')->email(),
                    TextInput::make('fax_email_connection_host')
                        ->label('Fax Email Connection Host')->email(),
                    TextInput::make('fax_email_connection_port')
                        ->label('Fax Email Connection Port')->email(),
                    TextInput::make('fax_email_connection_security')
                        ->label('Fax Email Connection Security')->email(),
                    TextInput::make('fax_email_connection_validate')
                        ->label('Fax Email Connection Validate')->email(),
                    TextInput::make('fax_email_connection_username')
                        ->label('Fax Email Connection Username')->email(),
                    TextInput::make('fax_email_connection_mailbox')
                        ->label('Fax Email Connection Mailbox')->email(),
                    TextInput::make('fax_email_inbound_subject_tag')
                        ->label('Fax Email Inbound Subject Tag')->email(),
                    TextInput::make('fax_email_outbound_subject_tag')
                        ->label('Fax Email Outbound Subject Tag')->email(),
                    TextInput::make('fax_email_outbound_authorized_senders')
                        ->label('Fax Email Outbound Authorized Senders')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_send_channels')
                        ->label('Fax Send Channels')
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
