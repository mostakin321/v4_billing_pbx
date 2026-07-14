<?php

namespace App\Filament\Resources\FusionPBX\CallCenterAgents\Schemas;

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

class CallCenterAgentForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Call Center Agent')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('agent_name')
                        ->label('Agent Name')->placeholder('agent name'),
                    TextInput::make('agent_type')
                        ->label('Agent Type')->placeholder('agent type'),
                    TextInput::make('agent_id')
                        ->label('Agent Id')->placeholder('agent id'),
                    TextInput::make('agent_password')
                        ->label('Agent Password')
                        ->password()->revealable(),
                    TextInput::make('agent_status')
                        ->label('Agent Status')->placeholder('agent status'),
                    TextInput::make('agent_logout')
                        ->label('Agent Logout')->placeholder('agent logout'),
                    TextInput::make('agent_wrap_up_time')
                        ->label('Agent Wrap Up Time')->placeholder('agent wrap up time'),
                    TextInput::make('agent_reject_delay_time')
                        ->label('Agent Reject Delay Time')->placeholder('agent reject delay time'),
                    TextInput::make('agent_busy_delay_time')
                        ->label('Agent Busy Delay Time')->placeholder('agent busy delay time'),
                    TextInput::make('agent_no_answer_delay_time')
                        ->label('Agent No Answer Delay Time')->placeholder('agent no answer delay time'),
                    TextInput::make('agent_record')
                        ->label('Agent Record')->placeholder('agent record'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('agent_call_timeout')
                        ->label('Agent Call Timeout')
                        ->numeric()->placeholder('30'),
                    TextInput::make('agent_contact')
                        ->label('Agent Contact')->placeholder('agent contact'),
                    TextInput::make('agent_max_no_answer')
                        ->label('Agent Max No Answer')
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
