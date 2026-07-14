<?php

namespace App\Filament\Resources\FusionPBX\Dialplans\Schemas;

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

class DialplanForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Dialplan')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('dialplan_name')
                        ->label('Name')->placeholder('name'),
                    TextInput::make('dialplan_number')
                        ->label('Number')->placeholder('number'),
                    TextInput::make('dialplan_destination')
                        ->label('Destination')->placeholder('destination'),
                    TextInput::make('dialplan_continue')
                        ->label('Continue')->placeholder('continue'),
                    Select::make('dialplan_enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('dialplan_description')
                        ->label('Description')->rows(2)->columnSpanFull(),
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
                    TextInput::make('dialplan_context')
                        ->label('Context')->placeholder('default'),
                    Textarea::make('dialplan_xml')
                        ->label('Xml')->rows(5)->columnSpanFull()->fontFamily(null),
                    TextInput::make('dialplan_order')
                        ->label('Order')
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
