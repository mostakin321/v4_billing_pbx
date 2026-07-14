<?php

namespace App\Filament\Resources\FusionPBX\DeviceKeys\Schemas;

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

class DeviceKeyForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Device Key')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('device_key_id')
                        ->label('Key Id')->placeholder('key id'),
                    TextInput::make('device_key_category')
                        ->label('Key Category')->placeholder('key category'),
                    TextInput::make('device_key_vendor')
                        ->label('Key Vendor')->placeholder('key vendor'),
                    TextInput::make('device_key_type')
                        ->label('Key Type')->placeholder('key type'),
                    TextInput::make('device_key_subtype')
                        ->label('Key Subtype')->placeholder('key subtype'),
                    TextInput::make('device_key_line')
                        ->label('Key Line')->placeholder('key line'),
                    TextInput::make('device_key_value')
                        ->label('Key Value')->placeholder('key value'),
                    TextInput::make('device_key_extension')
                        ->label('Key Extension')->placeholder('key extension'),
                    TextInput::make('device_key_protected')
                        ->label('Key Protected')->placeholder('key protected'),
                    TextInput::make('device_key_label')
                        ->label('Key Label')->placeholder('key label'),
                    TextInput::make('device_key_icon')
                        ->label('Key Icon')->placeholder('key icon'),
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
