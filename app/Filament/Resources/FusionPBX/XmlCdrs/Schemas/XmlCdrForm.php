<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrs\Schemas;

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

class XmlCdrForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Xml Cdr')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('domain_name')
                        ->label('Domain Name')->placeholder('domain name'),
                    TextInput::make('accountcode')
                        ->label('Accountcode')->placeholder('accountcode'),
                    TextInput::make('direction')
                        ->label('Direction')->placeholder('direction'),
                    TextInput::make('caller_destination')
                        ->label('Caller Destination')->placeholder('caller destination'),
                    TextInput::make('source_number')
                        ->label('Source Number')->placeholder('source number'),
                    TextInput::make('destination_number')
                        ->label('Destination Number')->placeholder('destination number'),
                    TextInput::make('start_epoch')
                        ->label('Start Epoch')->placeholder('start epoch'),
                    TextInput::make('start_stamp')
                        ->label('Start Stamp')->placeholder('start stamp'),
                    TextInput::make('answer_stamp')
                        ->label('Answer Stamp')->placeholder('answer stamp'),
                    TextInput::make('answer_epoch')
                        ->label('Answer Epoch')->placeholder('answer epoch'),
                    TextInput::make('end_epoch')
                        ->label('End Epoch')->placeholder('end epoch'),
                    TextInput::make('end_stamp')
                        ->label('End Stamp')->placeholder('end stamp'),
                    TextInput::make('duration')
                        ->label('Duration')->placeholder('duration'),
                    TextInput::make('mduration')
                        ->label('Mduration')->placeholder('mduration'),
                    TextInput::make('billsec')
                        ->label('Billsec')->placeholder('billsec'),
                    TextInput::make('billmsec')
                        ->label('Billmsec')->placeholder('billmsec'),
                    TextInput::make('read_rate')
                        ->label('Read Rate')->placeholder('read rate'),
                    TextInput::make('write_rate')
                        ->label('Write Rate')->placeholder('write rate'),
                    TextInput::make('remote_media_ip')
                        ->label('Remote Media Ip')->placeholder('remote media ip'),
                    TextInput::make('network_addr')
                        ->label('Network Addr')->placeholder('network addr'),
                    TextInput::make('record_path')
                        ->label('Record Path')->placeholder('record path'),
                    TextInput::make('record_name')
                        ->label('Record Name')->placeholder('record name'),
                    TextInput::make('record_length')
                        ->label('Record Length')->placeholder('record length'),
                    TextInput::make('leg')
                        ->label('Leg')->placeholder('leg'),
                    TextInput::make('pdd_ms')
                        ->label('Pdd Ms')->placeholder('pdd ms'),
                    TextInput::make('rtp_audio_in_mos')
                        ->label('Rtp Audio In Mos')->placeholder('rtp audio in mos'),
                    TextInput::make('last_app')
                        ->label('Last App')->placeholder('last app'),
                    TextInput::make('last_arg')
                        ->label('Last Arg')->placeholder('last arg'),
                    TextInput::make('cc_side')
                        ->label('Cc Side')->placeholder('cc side'),
                    TextInput::make('cc_queue_joined_epoch')
                        ->label('Cc Queue Joined Epoch')->placeholder('cc queue joined epoch'),
                    TextInput::make('cc_queue')
                        ->label('Cc Queue')->placeholder('cc queue'),
                    TextInput::make('cc_agent')
                        ->label('Cc Agent')->placeholder('cc agent'),
                    TextInput::make('cc_agent_type')
                        ->label('Cc Agent Type')->placeholder('cc agent type'),
                    TextInput::make('cc_agent_bridged')
                        ->label('Cc Agent Bridged')->placeholder('cc agent bridged'),
                    TextInput::make('cc_queue_answered_epoch')
                        ->label('Cc Queue Answered Epoch')->placeholder('cc queue answered epoch'),
                    TextInput::make('cc_queue_terminated_epoch')
                        ->label('Cc Queue Terminated Epoch')->placeholder('cc queue terminated epoch'),
                    TextInput::make('cc_queue_canceled_epoch')
                        ->label('Cc Queue Canceled Epoch')->placeholder('cc queue canceled epoch'),
                    TextInput::make('cc_cancel_reason')
                        ->label('Cc Cancel Reason')->placeholder('cc cancel reason'),
                    TextInput::make('cc_cause')
                        ->label('Cc Cause')->placeholder('cc cause'),
                    TextInput::make('waitsec')
                        ->label('Waitsec')->placeholder('waitsec'),
                    TextInput::make('conference_name')
                        ->label('Name')->placeholder('name'),
                    TextInput::make('conference_member_id')
                        ->label('Member Id')->placeholder('member id'),
                    TextInput::make('digits_dialed')
                        ->label('Digits Dialed')->placeholder('digits dialed'),
                    TextInput::make('pin_number')
                        ->label('Pin Number')
                        ->password()->revealable()->numeric(),
                    TextInput::make('status')
                        ->label('Status')->placeholder('status'),
                    TextInput::make('hangup_cause')
                        ->label('Hangup Cause')->placeholder('hangup cause'),
                    TextInput::make('hangup_cause_q850')
                        ->label('Hangup Cause Q850')->placeholder('hangup cause q850'),
                    TextInput::make('call_flow')
                        ->label('Call Flow')->placeholder('call flow'),
                    TextInput::make('LONGTEXT')
                        ->label('Longtext')->placeholder('longtext'),
                    TextInput::make('JSON')
                        ->label('Json')->placeholder('json'),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('caller_id_name')
                        ->label('Caller Id Name')->placeholder('caller id name'),
                    TextInput::make('caller_id_number')
                        ->label('Caller Id Number')->placeholder('caller id number'),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('default_language')
                        ->label('Default Language')->placeholder('en'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    Select::make('record_transcription')
                        ->label('Record Transcription')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    TextInput::make('voicemail_message')
                        ->label('Message')->email(),
                    TextInput::make('missed_call')
                        ->label('Missed Call')->placeholder('missed call'),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('sip_call_id')
                        ->label('Sip Call Id')->placeholder('sip call id'),
                    TextInput::make('context')
                        ->label('Context')->placeholder('default'),
                    TextInput::make('hold_accum_seconds')
                        ->label('Hold Accum Seconds')
                        ->numeric(),
                    TextInput::make('read_codec')
                        ->label('Read Codec')->placeholder('PCMU,PCMA'),
                    TextInput::make('write_codec')
                        ->label('Write Codec')->placeholder('PCMU,PCMA'),
                    TextInput::make('sip_hangup_disposition')
                        ->label('Sip Hangup Disposition')->placeholder('sip hangup disposition'),
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
