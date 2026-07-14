<?php

namespace App\Filament\Resources\FusionPBX\EventGuardLogs\Schemas;

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

class EventGuardLogForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Event Guard Log')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('log_date')
                        ->label('Log Date')->placeholder('log date'),
                    TextInput::make('filter')
                        ->label('Filter')->placeholder('filter'),
                    TextInput::make('ip_address')
                        ->label('Ip Address')->placeholder('ip address'),
                    TextInput::make('extension')
                        ->label('Extension')->placeholder('extension'),
                    TextInput::make('user_agent')
                        ->label('User Agent')->placeholder('user agent'),
                    TextInput::make('log_status')
                        ->label('Log Status')->placeholder('log status'),
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
