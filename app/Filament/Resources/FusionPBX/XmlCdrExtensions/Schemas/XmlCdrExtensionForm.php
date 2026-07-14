<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrExtensions\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class XmlCdrExtensionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Section::make('Xml Cdr Extension Details')
                ->columns(2)
                ->schema([
                    TextInput::make('start_stamp')
                        ->label('Start Stamp')
                        ->maxLength(255),
                    TextInput::make('end_stamp')
                        ->label('End Stamp')
                        ->maxLength(255),
                    TextInput::make('duration')
                        ->label('Duration')
                        ->maxLength(255),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()
                ->columns(3)
                ->schema([
                    Placeholder::make('domain_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->domain_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->domain_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')
                        ->label('Created')
                        ->content(fn ($record) => $record?->insert_date
                            ? Carbon::parse($record->insert_date)->format('M j, Y H:i')
                            : '—'),
                    Placeholder::make('update_date')
                        ->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date
                            ? Carbon::parse($record->update_date)->diffForHumans()
                            : '—'),
                ])
                ->visibleOn('edit'),
        ]);
    }
}
