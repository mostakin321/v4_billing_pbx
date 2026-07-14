<?php

namespace App\Filament\Resources\FusionPBX\Countries\Schemas;

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

class CountryForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Country')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('country')
                        ->label('Country')->placeholder('country'),
                    TextInput::make('iso_a2')
                        ->label('Iso A2')->placeholder('iso a2'),
                    TextInput::make('iso_a3')
                        ->label('Iso A3')->placeholder('iso a3'),
                    TextInput::make('num')
                        ->label('Num')->placeholder('num'),
                    TextInput::make('country_code')
                        ->label('Country Code')->placeholder('country code'),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([

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
