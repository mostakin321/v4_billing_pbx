<?php

namespace App\Filament\Resources\FusionPBX\Fifos\Schemas;

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

class FifoForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Fifo')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fifo_name')
                        ->label('Fifo Name')->placeholder('fifo name'),
                    TextInput::make('fifo_extension')
                        ->label('Fifo Extension')->placeholder('fifo extension'),
                    TextInput::make('fifo_agent_queue')
                        ->label('Fifo Agent Queue')->placeholder('fifo agent queue'),
                    TextInput::make('fifo_agent_status')
                        ->label('Fifo Agent Status')->placeholder('fifo agent status'),
                    TextInput::make('fifo_strategy')
                        ->label('Fifo Strategy')->placeholder('fifo strategy'),
                    TextInput::make('fifo_members')
                        ->label('Fifo Members')->placeholder('fifo members'),
                    TextInput::make('fifo_exit_key')
                        ->label('Fifo Exit Key')->placeholder('fifo exit key'),
                    TextInput::make('fifo_exit_action')
                        ->label('Fifo Exit Action')->placeholder('fifo exit action'),
                    Select::make('fifo_enabled')
                        ->label('Fifo Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('fifo_description')
                        ->label('Fifo Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fifo_music')
                        ->label('Fifo Music')->placeholder('fifo music'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('fifo_timeout_seconds')
                        ->label('Fifo Timeout Seconds')
                        ->numeric(),
                    TextInput::make('fifo_order')
                        ->label('Fifo Order')
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
