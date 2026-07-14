<?php

namespace App\Filament\Resources\FusionPBX\Destinations\Schemas;

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

class DestinationForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Destination')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('destination_type')
                        ->label('Destination Type')->placeholder('destination type'),
                    TextInput::make('destination_number')
                        ->label('Destination Number')->placeholder('destination number'),
                    TextInput::make('destination_trunk_prefix')
                        ->label('Destination Trunk Prefix')->placeholder('destination trunk prefix'),
                    TextInput::make('destination_area_code')
                        ->label('Destination Area Code')->placeholder('destination area code'),
                    TextInput::make('destination_prefix')
                        ->label('Destination Prefix')->placeholder('destination prefix'),
                    TextInput::make('destination_condition_field')
                        ->label('Destination Condition Field')->placeholder('destination condition field'),
                    TextInput::make('destination_number_regex')
                        ->label('Destination Number Regex')->placeholder('destination number regex'),
                    TextInput::make('destination_record')
                        ->label('Destination Record')->placeholder('destination record'),
                    TextInput::make('destination_distinctive_ring')
                        ->label('Destination Distinctive Ring')->placeholder('destination distinctive ring'),
                    TextInput::make('destination_accountcode')
                        ->label('Destination Accountcode')->placeholder('destination accountcode'),
                    TextInput::make('destination_type_fax')
                        ->label('Destination Type Fax')->placeholder('destination type fax'),
                    TextInput::make('destination_type_emergency')
                        ->label('Destination Type Emergency')->placeholder('destination type emergency'),
                    TextInput::make('destination_type_text')
                        ->label('Destination Type Text')->placeholder('destination type text'),
                    TextInput::make('destination_conditions')
                        ->label('Destination Conditions')->placeholder('destination conditions'),
                    TextInput::make('destination_actions')
                        ->label('Destination Actions')->placeholder('destination actions'),
                    TextInput::make('destination_app')
                        ->label('Destination App')->placeholder('destination app'),
                    TextInput::make('destination_data')
                        ->label('Destination Data')->placeholder('destination data'),
                    TextInput::make('destination_alternate_app')
                        ->label('Destination Alternate App')->placeholder('destination alternate app'),
                    TextInput::make('destination_alternate_data')
                        ->label('Destination Alternate Data')->placeholder('destination alternate data'),
                    Select::make('destination_enabled')
                        ->label('Destination Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                    Textarea::make('destination_description')
                        ->label('Destination Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Caller ID')
                                ->columns(2)
                                ->schema([
                    TextInput::make('destination_caller_id_name')
                        ->label('Destination Caller Id Name')->placeholder('destination caller id name'),
                    TextInput::make('destination_caller_id_number')
                        ->label('Destination Caller Id Number')->placeholder('destination caller id number'),
                    TextInput::make('destination_cid_name_prefix')
                        ->label('Destination Cid Name Prefix')->placeholder('destination cid name prefix'),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('destination_hold_music')
                        ->label('Destination Hold Music')->placeholder('local_stream://default'),
                    TextInput::make('destination_ringback')
                        ->label('Destination Ringback')->placeholder('destination ringback'),
                    TextInput::make('destination_type_voice')
                        ->label('Destination Type Voice')->placeholder('destination type voice'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('destination_email')
                        ->label('Destination Email')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('destination_context')
                        ->label('Destination Context')->placeholder('default'),
                    TextInput::make('destination_order')
                        ->label('Destination Order')
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
