<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Schemas;

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

class ConferenceSessionDetailForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Conference Session Detail')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('username')
                        ->label('Username')->placeholder('username'),
                    TextInput::make('moderator')
                        ->label('Moderator')->placeholder('moderator'),
                    TextInput::make('network_addr')
                        ->label('Network Addr')->placeholder('network addr'),
                    TextInput::make('start_epoch')
                        ->label('Start Epoch')->placeholder('start epoch'),
                    TextInput::make('end_epoch')
                        ->label('End Epoch')->placeholder('end epoch'),
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
