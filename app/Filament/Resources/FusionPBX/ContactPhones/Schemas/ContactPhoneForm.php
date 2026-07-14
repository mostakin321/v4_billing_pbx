<?php

namespace App\Filament\Resources\FusionPBX\ContactPhones\Schemas;

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

class ContactPhoneForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Contact Phone')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('phone_label')
                        ->label('Phone Label')->placeholder('phone label'),
                    TextInput::make('phone_type_fax')
                        ->label('Phone Type Fax')->placeholder('phone type fax'),
                    TextInput::make('phone_type_video')
                        ->label('Phone Type Video')->placeholder('phone type video'),
                    TextInput::make('phone_type_text')
                        ->label('Phone Type Text')->placeholder('phone type text'),
                    TextInput::make('phone_speed_dial')
                        ->label('Phone Speed Dial')->placeholder('phone speed dial'),
                    TextInput::make('phone_country_code')
                        ->label('Phone Country Code')->placeholder('phone country code'),
                    TextInput::make('phone_number')
                        ->label('Phone Number')->placeholder('phone number'),
                    TextInput::make('phone_extension')
                        ->label('Phone Extension')->placeholder('phone extension'),
                    TextInput::make('phone_primary')
                        ->label('Phone Primary')->placeholder('phone primary'),
                    Textarea::make('phone_description')
                        ->label('Phone Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),

                    Tabs\Tab::make('Audio')
                        ->icon('heroicon-o-speaker-wave')
                        ->schema([
                            Section::make('Audio')
                                ->columns(2)
                                ->schema([
                    TextInput::make('phone_type_voice')
                        ->label('Phone Type Voice')->placeholder('phone type voice'),
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
