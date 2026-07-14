<?php

namespace App\Filament\Resources\FusionPBX\CallCenterQueues\Schemas;

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

class CallCenterQueueForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Call Center Queue')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('queue_name')
                        ->label('Queue Name')->placeholder('queue name'),
                    TextInput::make('queue_extension')
                        ->label('Queue Extension')->placeholder('queue extension'),
                    TextInput::make('queue_strategy')
                        ->label('Queue Strategy')->placeholder('queue strategy'),
                    TextInput::make('queue_record_template')
                        ->label('Queue Record Template')->placeholder('queue record template'),
                    TextInput::make('queue_time_base_score')
                        ->label('Queue Time Base Score')->placeholder('queue time base score'),
                    TextInput::make('queue_time_base_score_sec')
                        ->label('Queue Time Base Score Sec')->placeholder('queue time base score sec'),
                    TextInput::make('queue_tier_rules_apply')
                        ->label('Queue Tier Rules Apply')->placeholder('queue tier rules apply'),
                    TextInput::make('queue_tier_rule_wait_second')
                        ->label('Queue Tier Rule Wait Second')->placeholder('queue tier rule wait second'),
                    TextInput::make('queue_tier_rule_no_agent_no_wait')
                        ->label('Queue Tier Rule No Agent No Wait')->placeholder('queue tier rule no agent no wait'),
                    TextInput::make('queue_discard_abandoned_after')
                        ->label('Queue Discard Abandoned After')->placeholder('queue discard abandoned after'),
                    TextInput::make('queue_abandoned_resume_allowed')
                        ->label('Queue Abandoned Resume Allowed')->placeholder('queue abandoned resume allowed'),
                    TextInput::make('queue_tier_rule_wait_multiply_level')
                        ->label('Queue Tier Rule Wait Multiply Level')->placeholder('queue tier rule wait multiply level'),
                    TextInput::make('queue_announce_position')
                        ->label('Queue Announce Position')->placeholder('queue announce position'),
                    TextInput::make('queue_announce_frequency')
                        ->label('Queue Announce Frequency')->placeholder('queue announce frequency'),
                    TextInput::make('queue_cc_exit_keys')
                        ->label('Queue Cc Exit Keys')->placeholder('queue cc exit keys'),
                    Textarea::make('queue_description')
                        ->label('Queue Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('queue_cid_prefix')
                        ->label('Queue Cid Prefix')->placeholder('queue cid prefix'),
                    TextInput::make('queue_outbound_caller_id_name')
                        ->label('Queue Outbound Caller Id Name')->placeholder('queue outbound caller id name'),
                    TextInput::make('queue_outbound_caller_id_number')
                        ->label('Queue Outbound Caller Id Number')->placeholder('queue outbound caller id number'),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('queue_greeting')
                        ->label('Queue Greeting')->placeholder('path/to/file.wav'),
                    TextInput::make('queue_moh_sound')
                        ->label('Queue Moh Sound')->placeholder('path/to/file.wav'),
                    TextInput::make('queue_language')
                        ->label('Queue Language')->placeholder('en'),
                    TextInput::make('queue_dialect')
                        ->label('Queue Dialect')->placeholder('us'),
                    TextInput::make('queue_voice')
                        ->label('Queue Voice')->placeholder('queue voice'),
                    TextInput::make('queue_announce_sound')
                        ->label('Queue Announce Sound')->placeholder('path/to/file.wav'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('queue_email_address')
                        ->label('Queue Email Address')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('queue_max_wait_time')
                        ->label('Queue Max Wait Time')
                        ->numeric(),
                    TextInput::make('queue_max_wait_time_with_no_agent')
                        ->label('Queue Max Wait Time With No Agent')
                        ->numeric(),
                    TextInput::make('queue_max_wait_time_with_no_agent_time_reached')
                        ->label('Queue Max Wait Time With No Agent Time Reached')
                        ->numeric(),
                    TextInput::make('queue_timeout_action')
                        ->label('Queue Timeout Action')
                        ->numeric(),
                    TextInput::make('queue_context')
                        ->label('Queue Context')->placeholder('default'),
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
