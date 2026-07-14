<?php

namespace App\Filament\Resources\FusionPBX\InboundRoutes\Schemas;

use Carbon\Carbon;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class InboundRouteForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Hidden::make('destination_type')->default('inbound'),

            Tabs::make('Inbound Route')->columnSpanFull()->tabs([

                Tabs\Tab::make('Main')->icon('heroicon-o-arrow-down-on-square')->schema([
                    Section::make('DID / Phone Number')
                        ->description('Inbound DID number that triggers this route.')
                        ->columns(3)->schema([
                            TextInput::make('destination_number')
                                ->label('DID Number')->required()
                                ->placeholder('^15551234567$')
                                ->helperText('Full E.164 number or regex pattern.')
                                ->columnSpan(2),
                            Select::make('destination_enabled')
                                ->label('Status')
                                ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                ->default('true')->native(false),
                            TextInput::make('destination_context')
                                ->label('Context')->placeholder('public')->default('public')
                                ->helperText('SIP context — usually "public".'),
                            TextInput::make('destination_prefix')
                                ->label('Prefix')->placeholder('1 or +1'),
                            TextInput::make('destination_area_code')
                                ->label('Area Code')->placeholder('555'),
                        ]),
                    Section::make('Routing Action')
                        ->description('Where to send this inbound call.')
                        ->columns(2)->schema([
                            TextInput::make('destination_app')
                                ->label('Application')->placeholder('transfer')
                                ->helperText('FreeSWITCH app: transfer, playback, lua...'),
                            TextInput::make('destination_data')
                                ->label('Destination / Target')
                                ->placeholder('1001 XML default')
                                ->helperText('Extension, IVR UUID, ring group UUID etc.'),
                            Textarea::make('destination_description')
                                ->label('Description')->rows(2)->columnSpanFull()
                                ->placeholder('Notes about this route...'),
                        ]),
                ]),

                Tabs\Tab::make('Caller ID')->icon('heroicon-o-identification')->schema([
                    Section::make('Caller ID Overrides')->columns(2)->schema([
                        TextInput::make('destination_caller_id_name')
                            ->label('Override CID Name')->placeholder('Company Name'),
                        TextInput::make('destination_caller_id_number')
                            ->label('Override CID Number')->placeholder('+15551234567'),
                        TextInput::make('destination_cid_name_prefix')
                            ->label('CID Name Prefix')->placeholder('[Sales] '),
                        TextInput::make('destination_accountcode')
                            ->label('Account Code')->placeholder('billing-001'),
                    ]),
                ]),

                Tabs\Tab::make('Advanced')->icon('heroicon-o-cog-6-tooth')->schema([
                    Section::make('Condition Matching')->columns(2)->schema([
                        TextInput::make('destination_condition_field')
                            ->label('Condition Field')->placeholder('destination_number'),
                        TextInput::make('destination_number_regex')
                            ->label('Number Regex')->placeholder('^15551234567$'),
                        TextInput::make('destination_trunk_prefix')->label('Trunk Prefix'),
                    ]),
                    Section::make('Features')->columns(3)->schema([
                        Select::make('destination_record')->label('Record Calls')
                            ->options(['true' => 'Yes', 'false' => 'No'])->default('false')->native(false),
                        Select::make('destination_type_fax')->label('Fax Detection')
                            ->options(['1' => 'Enabled', '0' => 'Disabled'])->default('0')->native(false),
                        TextInput::make('destination_distinctive_ring')->label('Distinctive Ring'),
                    ]),
                ]),
            ]),

            Section::make('Record Info')->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('destination_uuid')->label('UUID')
                        ->content(fn($r) => $r?->destination_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;">'.$r->destination_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn($r) => $r?->insert_date ? Carbon::parse($r->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Updated')
                        ->content(fn($r) => $r?->update_date ? Carbon::parse($r->update_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
