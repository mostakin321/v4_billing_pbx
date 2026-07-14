<?php

namespace App\Filament\Resources\FusionPBX\CallBroadcasts\Schemas;

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

class CallBroadcastForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Call Broadcast')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('broadcast_name')
                        ->label('Broadcast Name')->placeholder('broadcast name'),
                    Textarea::make('broadcast_description')
                        ->label('Broadcast Description')->rows(2)->columnSpanFull(),
                    TextInput::make('broadcast_start_time')
                        ->label('Broadcast Start Time')->placeholder('broadcast start time'),
                    TextInput::make('broadcast_concurrent_limit')
                        ->label('Broadcast Concurrent Limit')->placeholder('broadcast concurrent limit'),
                    TextInput::make('broadcast_destination_type')
                        ->label('Broadcast Destination Type')->placeholder('broadcast destination type'),
                    TextInput::make('broadcast_phone_numbers')
                        ->label('Broadcast Phone Numbers')->placeholder('broadcast phone numbers'),
                    TextInput::make('broadcast_avmd')
                        ->label('Broadcast Avmd')->placeholder('broadcast avmd'),
                    TextInput::make('broadcast_destination_data')
                        ->label('Broadcast Destination Data')->placeholder('broadcast destination data'),
                    TextInput::make('broadcast_accountcode')
                        ->label('Broadcast Accountcode')->placeholder('broadcast accountcode'),
                    TextInput::make('broadcast_toll_allow')
                        ->label('Broadcast Toll Allow')->placeholder('broadcast toll allow'),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('broadcast_caller_id_name')
                        ->label('Broadcast Caller Id Name')->placeholder('broadcast caller id name'),
                    TextInput::make('broadcast_caller_id_number')
                        ->label('Broadcast Caller Id Number')->placeholder('broadcast caller id number'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('broadcast_timeout')
                        ->label('Broadcast Timeout')
                        ->numeric()->placeholder('30'),
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
