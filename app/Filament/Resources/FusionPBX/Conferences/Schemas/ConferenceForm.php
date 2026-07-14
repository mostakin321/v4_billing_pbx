<?php

namespace App\Filament\Resources\FusionPBX\Conferences\Schemas;

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

class ConferenceForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Conference')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_name')
                        ->label('Name')->placeholder('name'),
                    TextInput::make('conference_extension')
                        ->label('Extension')->placeholder('extension'),
                    TextInput::make('conference_pin_number')
                        ->label('Pin Number')
                        ->password()->revealable()->numeric(),
                    TextInput::make('conference_profile')
                        ->label('Profile')->placeholder('profile'),
                    TextInput::make('conference_account_code')
                        ->label('Account Code')->placeholder('account code'),
                    TextInput::make('conference_flags')
                        ->label('Flags')->placeholder('flags'),
                    Textarea::make('conference_description')
                        ->label('Description')->rows(2)->columnSpanFull(),
                    Select::make('conference_enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Yes','false'=>'No'])->default('false'),
                                ]),
                        ]),

                    Tabs\Tab::make('Notifications')
                        ->icon('heroicon-o-bell')
                        ->schema([
                            Section::make('Notifications')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_email_address')
                        ->label('Email Address')->email(),
                                ]),
                        ]),

                    Tabs\Tab::make('Advanced')
                        ->icon('heroicon-o-cog-6-tooth')
                        ->schema([
                            Section::make('Advanced')
                                ->columns(2)
                                ->schema([
                    TextInput::make('conference_order')
                        ->label('Order')
                        ->numeric(),
                    TextInput::make('conference_context')
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
