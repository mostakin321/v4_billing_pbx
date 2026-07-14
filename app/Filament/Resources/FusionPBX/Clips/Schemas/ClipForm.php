<?php

namespace App\Filament\Resources\FusionPBX\Clips\Schemas;

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

class ClipForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Clip')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('clip_name')
                        ->label('Clip Name')->placeholder('clip name'),
                    TextInput::make('clip_folder')
                        ->label('Clip Folder')->placeholder('clip folder'),
                    TextInput::make('clip_text_start')
                        ->label('Clip Text Start')->placeholder('clip text start'),
                    TextInput::make('clip_text_end')
                        ->label('Clip Text End')->placeholder('clip text end'),
                    TextInput::make('clip_desc')
                        ->label('Clip Desc')->placeholder('clip desc'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('clip_order')
                        ->label('Clip Order')
                        ->numeric(),
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
