<?php

namespace App\Filament\Resources\FusionPBX\PhraseDetails\Schemas;

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

class PhraseDetailForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Phrase Detail')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('phrase_detail_group')
                        ->label('Phrase Detail Group')->placeholder('phrase detail group'),
                    TextInput::make('phrase_detail_tag')
                        ->label('Phrase Detail Tag')->placeholder('phrase detail tag'),
                    TextInput::make('phrase_detail_pattern')
                        ->label('Phrase Detail Pattern')->placeholder('phrase detail pattern'),
                    TextInput::make('phrase_detail_function')
                        ->label('Phrase Detail Function')->placeholder('phrase detail function'),
                    TextInput::make('phrase_detail_data')
                        ->label('Phrase Detail Data')->placeholder('phrase detail data'),
                    TextInput::make('phrase_detail_method')
                        ->label('Phrase Detail Method')->placeholder('phrase detail method'),
                    TextInput::make('phrase_detail_type')
                        ->label('Phrase Detail Type')->placeholder('phrase detail type'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('phrase_detail_order')
                        ->label('Phrase Detail Order')
                        ->numeric(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('phrase_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->phrase_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->phrase_uuid.'</code>')
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
