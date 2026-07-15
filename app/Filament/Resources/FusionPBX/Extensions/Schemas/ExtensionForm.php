<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Schemas;

use App\Models\FusionPBX\User;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class ExtensionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Tabs::make('Extension')
                ->columnSpanFull()
                ->tabs([

                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-phone')
                        ->schema([
                            Section::make('Extension Identity')
                                ->description('Core extension number and authentication.')
                                ->icon('heroicon-o-identification')
                                ->columns(3)
                                ->schema([
                                    TextInput::make('extension')
                                        ->label('Extension')->required()
                                        ->placeholder('e.g. 1001')
                                        ->helperText('Alphanumeric, 2–15 digits.'),
                                    TextInput::make('number_alias')
                                        ->label('Number Alias')
                                        ->placeholder('e.g. 5551234567'),
                                    TextInput::make('accountcode')
                                        ->label('Account Code')
                                        ->placeholder('e.g. billing-001'),
                                    TextInput::make('password')
                                        ->label('SIP Password')
                                        ->password()->revealable()
                                        ->placeholder('••••••••'),
                                    TextInput::make('user_context')
                                        ->label('User Context')
                                        ->placeholder('default'),
                                ]),
                            Section::make('Assigned Users')
                                ->description('Users who can access this extension in the softphone / mobile app.')
                                ->icon('heroicon-o-user-group')
                                ->columns(1)
                                ->schema([
                                    Select::make('users')
                                        ->label('Users')
                                        ->multiple()
                                        ->native(false)
                                        ->searchable()
                                        ->options(fn () => User::pluck('username', 'user_uuid'))
                                        ->dehydrated(false)
                                        ->helperText('Assign users to this extension.'),
                                ]),

                            Section::make('Status')
                                ->columns(2)
                                ->schema([
                                    Select::make('enabled')
                                        ->label('Status')
                                        ->options(['true' => 'Enabled', 'false' => 'Disabled'])
                                        ->default('true')->native(false),
                                    Select::make('do_not_disturb')
                                        ->label('Do Not Disturb')
                                        ->options(['true' => 'On', 'false' => 'Off'])
                                        ->default('false')->native(false),
                                    Textarea::make('description')
                                        ->label('Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Caller ID')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Internal (Effective)')->columns(2)->schema([
                                TextInput::make('effective_caller_id_name')->label('CID Name')->placeholder('John Smith'),
                                TextInput::make('effective_caller_id_number')->label('CID Number')->placeholder('1001'),
                            ]),
                            Section::make('External (Outbound)')->columns(2)->schema([
                                TextInput::make('outbound_caller_id_name')->label('Outbound CID Name')->placeholder('Company Name'),
                                TextInput::make('outbound_caller_id_number')->label('Outbound CID Number')->placeholder('+15551234567'),
                            ]),
                            Section::make('Emergency')->columns(2)->schema([
                                TextInput::make('emergency_caller_id_name')->label('Emergency CID Name'),
                                TextInput::make('emergency_caller_id_number')->label('Emergency CID Number'),
                            ]),
                        ]),

                    Tabs\Tab::make('Forwarding')
                        ->icon('heroicon-o-arrow-path')
                        ->schema([
                            Section::make('Forward All Calls')->columns(2)->schema([
                                TextInput::make('forward_all_destination')->label('Destination')->placeholder('e.g. 1002'),
                                Select::make('forward_all_enabled')->label('Enabled')->options(['true'=>'Yes','false'=>'No'])->default('false')->native(false),
                            ]),
                            Section::make('Forward on Busy')->columns(2)->schema([
                                TextInput::make('forward_busy_destination')->label('Destination')->placeholder('voicemail'),
                                Select::make('forward_busy_enabled')->label('Enabled')->options(['true'=>'Yes','false'=>'No'])->default('false')->native(false),
                            ]),
                            Section::make('Forward on No Answer')->columns(2)->schema([
                                TextInput::make('forward_no_answer_destination')->label('Destination')->placeholder('voicemail'),
                                Select::make('forward_no_answer_enabled')->label('Enabled')->options(['true'=>'Yes','false'=>'No'])->default('false')->native(false),
                            ]),
                            Section::make('Forward — Not Registered')->columns(2)->schema([
                                TextInput::make('forward_user_not_registered_destination')->label('Destination')->placeholder('mobile'),
                                Select::make('forward_user_not_registered_enabled')->label('Enabled')->options(['true'=>'Yes','false'=>'No'])->default('false')->native(false),
                            ]),
                            Section::make('Follow Me')->columns(2)->schema([
                                TextInput::make('follow_me_destinations')->label('Destinations')->placeholder('Comma-separated'),
                                Select::make('follow_me_enabled')->label('Enabled')->options(['true'=>'Yes','false'=>'No'])->default('false')->native(false),
                            ]),
                        ]),

                    Tabs\Tab::make('Directory')
                        ->icon('heroicon-o-book-open')
                        ->schema([
                            Section::make('Directory Listing')->columns(2)->schema([
                                TextInput::make('directory_first_name')->label('First Name')->placeholder('John'),
                                TextInput::make('directory_last_name')->label('Last Name')->placeholder('Smith'),
                                Select::make('directory_visible')->label('Visible')->options(['true'=>'Yes','false'=>'No'])->default('true')->native(false),
                                Select::make('directory_exten_visible')->label('Show Extension')->options(['true'=>'Yes','false'=>'No'])->default('true')->native(false),
                            ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Call Limits')->columns(3)->schema([
                                TextInput::make('call_timeout')->label('Timeout (sec)')->numeric()->placeholder('30'),
                                TextInput::make('limit_max')->label('Max Concurrent Calls')->numeric()->placeholder('5'),
                                TextInput::make('max_registrations')->label('Max Registrations')->numeric()->placeholder('1'),
                                TextInput::make('limit_destination')->label('Limit Destination')->placeholder('error/user_busy'),
                                TextInput::make('call_group')->label('Call Group')->placeholder('sales'),
                                Select::make('call_screen_enabled')->label('Call Screen')->options(['true'=>'Enabled','false'=>'Disabled'])->default('false')->native(false),
                            ]),
                            Section::make('SIP')->columns(3)->schema([
                                TextInput::make('sip_force_contact')->label('Force Contact'),
                                TextInput::make('sip_force_expires')->label('Force Expires')->numeric(),
                                TextInput::make('sip_bypass_media')->label('Bypass Media'),
                                TextInput::make('auth_acl')->label('Auth ACL')->placeholder('localnet'),
                                TextInput::make('mwi_account')->label('MWI Account')->placeholder('user@domain'),
                                TextInput::make('hold_music')->label('Hold Music')->placeholder('local_stream://default'),
                            ]),
                            Section::make('Recording & Codecs')->columns(3)->schema([
                                Select::make('user_record')->label('Record Calls')
                                    ->options(['all'=>'All','local'=>'Local','inbound'=>'Inbound','outbound'=>'Outbound','none'=>'None'])
                                    ->default('none')->native(false),
                                TextInput::make('absolute_codec_string')->label('Codec String')->placeholder('PCMU,PCMA'),
                                Select::make('extension_type')->label('Type')->options(['user'=>'User','virtual'=>'Virtual'])->default('user')->native(false),
                            ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('extension_uuid')->label('UUID')
                        ->content(fn ($record) => $record?->extension_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;">'.$record->extension_uuid.'</code>')
                            : 'Assigned on save'),
                    Placeholder::make('insert_date')->label('Created')
                        ->content(fn ($record) => $record?->insert_date ? Carbon::parse($record->insert_date)->format('M j, Y H:i') : '—'),
                    Placeholder::make('update_date')->label('Last Updated')
                        ->content(fn ($record) => $record?->update_date ? Carbon::parse($record->update_date)->diffForHumans() : '—'),
                ])->visibleOn('edit'),
        ]);
    }
}
