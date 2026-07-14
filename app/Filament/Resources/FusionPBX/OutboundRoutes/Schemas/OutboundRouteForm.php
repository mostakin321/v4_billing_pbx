<?php
namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Schemas;
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

class OutboundRouteForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Hidden::make('destination_type')->default('outbound'),

            Tabs::make('Outbound Route')->columnSpanFull()->tabs([

                Tabs\Tab::make('Main')->icon('heroicon-o-arrow-up-on-square')->schema([
                    Section::make('Outbound Route')
                        ->description('Pattern matching for outbound calls.')
                        ->columns(3)->schema([
                            TextInput::make('destination_number')
                                ->label('Number Pattern')->required()
                                ->placeholder('^1?([2-9]\d{9})$')
                                ->helperText('Regex pattern to match dialed numbers.')
                                ->columnSpan(2),
                            Select::make('destination_enabled')
                                ->label('Status')
                                ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                ->default('true')->native(false),
                            TextInput::make('destination_prefix')
                                ->label('Dial Prefix')->placeholder('9 or 1')
                                ->helperText('Strip prefix before sending.'),
                            TextInput::make('destination_trunk_prefix')
                                ->label('Trunk Prefix')->placeholder('1'),
                            TextInput::make('destination_area_code')
                                ->label('Area Code')->placeholder('555'),
                        ]),
                    Section::make('Gateway / Trunk')
                        ->description('Where to send this outbound call.')->columns(2)->schema([
                            TextInput::make('destination_app')
                                ->label('Application')->placeholder('bridge')
                                ->helperText('FreeSWITCH app: bridge, transfer...'),
                            TextInput::make('destination_data')
                                ->label('Gateway / Data')
                                ->placeholder('sofia/gateway/mygateway/$1')
                                ->helperText('Gateway dial string or target.'),
                            TextInput::make('destination_context')
                                ->label('Context')->placeholder('default'),
                            TextInput::make('destination_accountcode')
                                ->label('Account Code')->placeholder('billing-001'),
                            Textarea::make('destination_description')
                                ->label('Description')->rows(2)->columnSpanFull()
                                ->placeholder('Notes about this outbound route...'),
                        ]),
                ]),

                Tabs\Tab::make('Caller ID')->icon('heroicon-o-identification')->schema([
                    Section::make('Caller ID')->columns(2)->schema([
                        TextInput::make('destination_caller_id_name')
                            ->label('Override CID Name')->placeholder('Company Name'),
                        TextInput::make('destination_caller_id_number')
                            ->label('Override CID Number')->placeholder('+15551234567'),
                        TextInput::make('destination_cid_name_prefix')
                            ->label('CID Name Prefix')->placeholder('[Out] '),
                        Select::make('destination_record')
                            ->label('Record Calls')
                            ->options(['true' => 'Yes', 'false' => 'No'])->default('false')->native(false),
                    ]),
                ]),

                Tabs\Tab::make('Advanced')->icon('heroicon-o-cog-6-tooth')->schema([
                    Section::make('Condition Matching')->columns(2)->schema([
                        TextInput::make('destination_condition_field')
                            ->label('Condition Field')->placeholder('destination_number'),
                        TextInput::make('destination_number_regex')
                            ->label('Number Regex')->placeholder('^1?([2-9]\d{9})$'),
                        TextInput::make('destination_toll_allow')
                            ->label('Toll Allow')->placeholder('domestic,international'),
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
