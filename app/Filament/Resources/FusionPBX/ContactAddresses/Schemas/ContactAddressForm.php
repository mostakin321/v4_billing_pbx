<?php

namespace App\Filament\Resources\FusionPBX\ContactAddresses\Schemas;

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

class ContactAddressForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Contact Address')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('address_type')
                        ->label('Address Type')->placeholder('address type'),
                    TextInput::make('address_label')
                        ->label('Address Label')->placeholder('address label'),
                    TextInput::make('address_primary')
                        ->label('Address Primary')->placeholder('address primary'),
                    TextInput::make('address_street')
                        ->label('Address Street')->placeholder('address street'),
                    TextInput::make('address_extended')
                        ->label('Address Extended')->placeholder('address extended'),
                    TextInput::make('address_community')
                        ->label('Address Community')->placeholder('address community'),
                    TextInput::make('address_locality')
                        ->label('Address Locality')->placeholder('address locality'),
                    TextInput::make('address_region')
                        ->label('Address Region')->placeholder('address region'),
                    TextInput::make('address_postal_code')
                        ->label('Address Postal Code')->placeholder('address postal code'),
                    TextInput::make('address_country')
                        ->label('Address Country')->placeholder('address country'),
                    TextInput::make('address_latitude')
                        ->label('Address Latitude')->placeholder('address latitude'),
                    TextInput::make('address_longitude')
                        ->label('Address Longitude')->placeholder('address longitude'),
                    Textarea::make('address_description')
                        ->label('Address Description')->rows(2)->columnSpanFull(),
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
