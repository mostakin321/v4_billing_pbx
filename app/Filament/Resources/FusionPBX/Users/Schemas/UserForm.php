<?php

namespace App\Filament\Resources\FusionPBX\Users\Schemas;

use App\Models\FusionPBX\Contact;
use App\Models\FusionPBX\Group;
use Carbon\Carbon;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class UserForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('User')
                ->columnSpanFull()
                ->tabs([

                    Tabs\Tab::make('Account')
                        ->icon('heroicon-o-user')
                        ->schema([
                            Section::make('Login')
                                ->columns(2)
                                ->schema([
                                    TextInput::make('username')
                                        ->label('Username')
                                        ->required()
                                        ->maxLength(255),

                                    TextInput::make('password')
                                        ->label('Password')
                                        ->password()
                                        ->revealable()
                                        ->dehydrateStateUsing(fn ($state) => filled($state) ? Hash::make($state) : null)
                                        ->dehydrated(fn ($state) => filled($state))
                                        ->required(fn (string $operation): bool => $operation === 'create')
                                        ->rule('min:8'),

                                    TextInput::make('password_confirmation')
                                        ->label('Confirm Password')
                                        ->password()
                                        ->revealable()
                                        ->same('password')
                                        ->dehydrated(false)
                                        ->required(fn (string $operation): bool => $operation === 'create'),

                                    TextInput::make('user_email')
                                        ->label('Email')
                                        ->email()
                                        ->maxLength(255),
                                ]),

                            Section::make('Status')
                                ->columns(2)
                                ->schema([
                                    Select::make('user_status')
                                        ->label('Status')
                                        ->native(false)
                                        ->options([
                                            'Available' => 'Available',
                                            'Available (On Demand)' => 'Available (On Demand)',
                                            'Do Not Disturb' => 'Do Not Disturb',
                                            'Out to Lunch' => 'Out to Lunch',
                                        ])
                                        ->default('Available'),

                                    Toggle::make('user_enabled')
                                        ->label('Enabled')
                                        ->default(true),

                                    Select::make('user_type')
                                        ->label('Type')
                                        ->native(false)
                                        ->options([
                                            'default' => 'Default',
                                            'virtual' => 'Virtual',
                                        ])
                                        ->default('default')
                                        ->helperText('Virtual users cannot log in.'),
                                ]),
                        ]),

                    Tabs\Tab::make('Profile')
                        ->icon('heroicon-o-identification')
                        ->schema([
                            Section::make('Localization')
                                ->columns(2)
                                ->schema([
                                    Select::make('user_language')
                                        ->label('Language')
                                        ->native(false)
                                        ->options([
                                            'en-us' => 'English (US)',
                                            'en-gb' => 'English (UK)',
                                            'es-es' => 'Spanish',
                                            'fr-fr' => 'French',
                                            'de-de' => 'German',
                                        ])
                                        ->default('en-us')
                                        ->dehydrated(false),

                                    Select::make('user_time_zone')
                                        ->label('Time Zone')
                                        ->native(false)
                                        ->options(collect(\DateTimeZone::listIdentifiers())
                                            ->mapWithKeys(fn ($tz) => [$tz => $tz]))
                                        ->searchable()
                                        ->default('UTC')
                                        ->dehydrated(false),
                                ]),

                            Section::make('Contact')
                                ->columns(1)
                                ->schema([
                                    Select::make('contact_uuid')
                                        ->label('Linked Contact')
                                        ->native(false)
                                        ->searchable()
                                        ->options(fn () => Contact::query()
                                            ->limit(100)
                                            ->get()
                                            ->mapWithKeys(fn ($c) => [
                                                $c->contact_uuid => trim(
                                                    "{$c->contact_name_given} {$c->contact_name_family}"
                                                ) ?: $c->contact_organization ?: $c->contact_uuid,
                                            ]))
                                        ->dehydrated(true)
                                        ->helperText('Optional — links this login to a contact record.'),
                                ]),
                        ]),

                    Tabs\Tab::make('Groups')
                        ->icon('heroicon-o-user-group')
                        ->schema([
                            Section::make('Group Membership')
                                ->columns(1)
                                ->schema([
                                    Select::make('groups')
                                        ->label('Groups')
                                        ->multiple()
                                        ->native(false)
                                        ->options(fn () => Group::pluck('group_name', 'group_uuid'))
                                        ->dehydrated(false)
                                        ->helperText('Controls panel access and permissions.'),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('user_uuid_display')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->user_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->user_uuid.'</code>')
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
