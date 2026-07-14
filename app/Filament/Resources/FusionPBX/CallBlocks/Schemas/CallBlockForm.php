<?php

namespace App\Filament\Resources\FusionPBX\CallBlocks\Schemas;

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

class CallBlockForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Call Block')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('call_block_direction')
                        ->label('Direction')->placeholder('direction'),
                    TextInput::make('call_block_name')
                        ->label('Name')->placeholder('name'),
                    TextInput::make('call_block_country_code')
                        ->label('Country Code')->placeholder('country code'),
                    TextInput::make('call_block_number')
                        ->label('Number')->placeholder('number'),
                    TextInput::make('call_block_count')
                        ->label('Count')->placeholder('count'),
                    TextInput::make('call_block_action')
                        ->label('Action')->placeholder('action'),
                    TextInput::make('call_block_app')
                        ->label('App')->placeholder('app'),
                    TextInput::make('call_block_data')
                        ->label('Data')->placeholder('data'),
                    TextInput::make('date_added')
                        ->label('Date Added')->placeholder('date added'),
                    Select::make('call_block_enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('call_block_description')
                        ->label('Description')->rows(2)->columnSpanFull(),
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
