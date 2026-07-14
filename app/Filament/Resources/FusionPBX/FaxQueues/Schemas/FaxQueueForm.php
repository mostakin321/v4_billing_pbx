<?php

namespace App\Filament\Resources\FusionPBX\FaxQueues\Schemas;

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

class FaxQueueForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Fax Queue')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_date')
                        ->label('Fax Date')->placeholder('fax date'),
                    TextInput::make('fax_recipient')
                        ->label('Fax Recipient')->placeholder('fax recipient'),
                    TextInput::make('fax_number')
                        ->label('Fax Number')->placeholder('fax number'),
                    TextInput::make('fax_prefix')
                        ->label('Fax Prefix')->placeholder('fax prefix'),
                    TextInput::make('fax_file')
                        ->label('Fax File')->placeholder('fax file'),
                    TextInput::make('fax_status')
                        ->label('Fax Status')->placeholder('fax status'),
                    TextInput::make('fax_retry_date')
                        ->label('Fax Retry Date')->placeholder('fax retry date'),
                    TextInput::make('fax_notify_sent')
                        ->label('Fax Notify Sent')->placeholder('fax notify sent'),
                    TextInput::make('fax_notify_date')
                        ->label('Fax Notify Date')->placeholder('fax notify date'),
                    TextInput::make('fax_retry_count')
                        ->label('Fax Retry Count')->placeholder('fax retry count'),
                    TextInput::make('fax_accountcode')
                        ->label('Fax Accountcode')->placeholder('fax accountcode'),
                    TextInput::make('fax_command')
                        ->label('Fax Command')->placeholder('fax command'),
                    TextInput::make('fax_response')
                        ->label('Fax Response')->placeholder('fax response'),
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
                    TextInput::make('fax_email_address')
                        ->label('Fax Email Address')->email(),
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
