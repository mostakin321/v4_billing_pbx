<?php

namespace App\Filament\Resources\FusionPBX\CallFlows\Schemas;

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

class CallFlowForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Call Flow')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('call_flow_name')
                        ->label('Name')->placeholder('name'),
                    TextInput::make('call_flow_extension')
                        ->label('Extension')->placeholder('extension'),
                    TextInput::make('call_flow_feature_code')
                        ->label('Feature Code')->placeholder('feature code'),
                    TextInput::make('call_flow_status')
                        ->label('Status')->placeholder('status'),
                    TextInput::make('call_flow_pin_number')
                        ->label('Pin Number')
                        ->password()->revealable()->numeric(),
                    TextInput::make('call_flow_label')
                        ->label('Label')->placeholder('label'),
                    TextInput::make('call_flow_app')
                        ->label('App')->placeholder('app'),
                    TextInput::make('call_flow_data')
                        ->label('Data')->placeholder('data'),
                    TextInput::make('call_flow_alternate_label')
                        ->label('Alternate Label')->placeholder('alternate label'),
                    TextInput::make('call_flow_alternate_app')
                        ->label('Alternate App')->placeholder('alternate app'),
                    TextInput::make('call_flow_alternate_data')
                        ->label('Alternate Data')->placeholder('alternate data'),
                    Select::make('call_flow_enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('call_flow_description')
                        ->label('Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('call_flow_sound')
                        ->label('Sound')->placeholder('path/to/file.wav'),
                    TextInput::make('call_flow_alternate_sound')
                        ->label('Alternate Sound')->placeholder('path/to/file.wav'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('call_flow_context')
                        ->label('Context')->placeholder('default'),
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
