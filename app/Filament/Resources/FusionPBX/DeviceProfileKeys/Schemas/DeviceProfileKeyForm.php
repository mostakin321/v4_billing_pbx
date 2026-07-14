<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileKeys\Schemas;

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

class DeviceProfileKeyForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Device Profile Key')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('profile_key_id')
                        ->label('Profile Key Id')->placeholder('profile key id'),
                    TextInput::make('profile_key_category')
                        ->label('Profile Key Category')->placeholder('profile key category'),
                    TextInput::make('profile_key_vendor')
                        ->label('Profile Key Vendor')->placeholder('profile key vendor'),
                    TextInput::make('profile_key_type')
                        ->label('Profile Key Type')->placeholder('profile key type'),
                    TextInput::make('profile_key_subtype')
                        ->label('Profile Key Subtype')->placeholder('profile key subtype'),
                    TextInput::make('profile_key_line')
                        ->label('Profile Key Line')->placeholder('profile key line'),
                    TextInput::make('profile_key_value')
                        ->label('Profile Key Value')->placeholder('profile key value'),
                    TextInput::make('profile_key_extension')
                        ->label('Profile Key Extension')->placeholder('profile key extension'),
                    TextInput::make('profile_key_protected')
                        ->label('Profile Key Protected')->placeholder('profile key protected'),
                    TextInput::make('profile_key_label')
                        ->label('Profile Key Label')->placeholder('profile key label'),
                    TextInput::make('profile_key_icon')
                        ->label('Profile Key Icon')->placeholder('profile key icon'),
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
