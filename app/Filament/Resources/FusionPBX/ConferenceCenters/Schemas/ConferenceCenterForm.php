<?php

namespace App\Filament\Resources\FusionPBX\ConferenceCenters\Schemas;

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

class ConferenceCenterForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Conference Center')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_center_name')
                        ->label('Center Name')->placeholder('center name'),
                    TextInput::make('conference_center_extension')
                        ->label('Center Extension')->placeholder('center extension'),
                    TextInput::make('conference_center_pin_length')
                        ->label('Center Pin Length')
                        ->password()->revealable()->numeric(),
                    Textarea::make('conference_center_description')
                        ->label('Center Description')->rows(2)->columnSpanFull(),
                    Select::make('conference_center_enabled')
                        ->label('Center Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_center_greeting')
                        ->label('Center Greeting')->placeholder('path/to/file.wav'),
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
