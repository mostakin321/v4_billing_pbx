<?php

namespace App\Filament\Resources\FusionPBX\FaxFiles\Schemas;

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

class FaxFileForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Fax File')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fax_mode')
                        ->label('Fax Mode')->placeholder('fax mode'),
                    TextInput::make('fax_recipient')
                        ->label('Fax Recipient')->placeholder('fax recipient'),
                    TextInput::make('fax_destination')
                        ->label('Fax Destination')->placeholder('fax destination'),
                    TextInput::make('fax_file_type')
                        ->label('Fax File Type')->placeholder('fax file type'),
                    TextInput::make('fax_file_path')
                        ->label('Fax File Path')->placeholder('fax file path'),
                    TextInput::make('fax_date')
                        ->label('Fax Date')->placeholder('fax date'),
                    TextInput::make('fax_epoch')
                        ->label('Fax Epoch')->placeholder('fax epoch'),
                    TextInput::make('fax_base64')
                        ->label('Fax Base64')->placeholder('fax base64'),
                    TextInput::make('read_date')
                        ->label('Read Date')->placeholder('read date'),
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
