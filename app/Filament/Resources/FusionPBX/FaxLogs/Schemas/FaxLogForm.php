<?php

namespace App\Filament\Resources\FusionPBX\FaxLogs\Schemas;

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

class FaxLogForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Fax Log')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_success')
                        ->label('Fax Success')->placeholder('fax success'),
                    TextInput::make('fax_result_code')
                        ->label('Fax Result Code')->placeholder('fax result code'),
                    TextInput::make('fax_result_text')
                        ->label('Fax Result Text')->placeholder('fax result text'),
                    TextInput::make('fax_file')
                        ->label('Fax File')->placeholder('fax file'),
                    TextInput::make('fax_ecm_used')
                        ->label('Fax Ecm Used')->placeholder('fax ecm used'),
                    TextInput::make('fax_local_station_id')
                        ->label('Fax Local Station Id')->placeholder('fax local station id'),
                    TextInput::make('fax_document_transferred_pages')
                        ->label('Fax Document Transferred Pages')->placeholder('fax document transferred pages'),
                    TextInput::make('fax_document_total_pages')
                        ->label('Fax Document Total Pages')->placeholder('fax document total pages'),
                    TextInput::make('fax_image_resolution')
                        ->label('Fax Image Resolution')->placeholder('fax image resolution'),
                    TextInput::make('fax_image_size')
                        ->label('Fax Image Size')->placeholder('fax image size'),
                    TextInput::make('fax_bad_rows')
                        ->label('Fax Bad Rows')->placeholder('fax bad rows'),
                    TextInput::make('fax_transfer_rate')
                        ->label('Fax Transfer Rate')->placeholder('fax transfer rate'),
                    TextInput::make('fax_retry_limit')
                        ->label('Fax Retry Limit')->placeholder('fax retry limit'),
                    TextInput::make('fax_retry_sleep')
                        ->label('Fax Retry Sleep')->placeholder('fax retry sleep'),
                    TextInput::make('fax_uri')
                        ->label('Fax Uri')->placeholder('fax uri'),
                    TextInput::make('fax_duration')
                        ->label('Fax Duration')->placeholder('fax duration'),
                    TextInput::make('fax_date')
                        ->label('Fax Date')->placeholder('fax date'),
                    TextInput::make('fax_epoch')
                        ->label('Fax Epoch')->placeholder('fax epoch'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_retry_attempts')
                        ->label('Fax Retry Attempts')
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
