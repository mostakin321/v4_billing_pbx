<?php

namespace App\Filament\Resources\FusionPBX\Databases\Schemas;

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

class DatabasForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Databas')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('database_driver')
                        ->label('Database Driver')->placeholder('database driver'),
                    TextInput::make('database_type')
                        ->label('Database Type')->placeholder('database type'),
                    TextInput::make('database_host')
                        ->label('Database Host')->placeholder('database host'),
                    TextInput::make('database_port')
                        ->label('Database Port')->placeholder('database port'),
                    TextInput::make('database_name')
                        ->label('Database Name')->placeholder('database name'),
                    TextInput::make('database_username')
                        ->label('Database Username')->placeholder('database username'),
                    TextInput::make('database_password')
                        ->label('Database Password')
                        ->password()->revealable(),
                    TextInput::make('database_path')
                        ->label('Database Path')->placeholder('database path'),
                    Textarea::make('database_description')
                        ->label('Database Description')->rows(2)->columnSpanFull(),
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
