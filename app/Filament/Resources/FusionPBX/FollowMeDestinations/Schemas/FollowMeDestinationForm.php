<?php

namespace App\Filament\Resources\FusionPBX\FollowMeDestinations\Schemas;

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

class FollowMeDestinationForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Follow Me Destination')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Forwarding')
                        ->icon('heroicon-o-arrow-path')
                        ->schema([
                            Section::make('Forwarding')
                                ->columns(2)
                                ->schema([
                    TextInput::make('follow_me_destination')
                        ->label('Follow Me Destination')->placeholder('follow me destination'),
                    TextInput::make('follow_me_delay')
                        ->label('Follow Me Delay')->placeholder('follow me delay'),
                    TextInput::make('follow_me_timeout')
                        ->label('Follow Me Timeout')->placeholder('follow me timeout'),
                    TextInput::make('follow_me_prompt')
                        ->label('Follow Me Prompt')->placeholder('follow me prompt'),
                    TextInput::make('follow_me_order')
                        ->label('Follow Me Order')->placeholder('follow me order'),
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
