<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Schemas;

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

class DeviceVendorFunctionForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([

            Tabs::make('Device Vendor Function')
                ->columnSpanFull()
                ->tabs([
                    Tabs\Tab::make('Main')
                        ->icon('heroicon-o-home')
                        ->schema([
                            Section::make('Main')
                                ->columns(2)
                                ->schema([
                    TextInput::make('type')
                        ->label('Type')->placeholder('type'),
                    TextInput::make('subtype')
                        ->label('Subtype')->placeholder('subtype'),
                    TextInput::make('value')
                        ->label('Value')->placeholder('value'),
                    Select::make('enabled')
                        ->label('Enabled')
                        ->native(false)->options(['true'=>'Enabled','false'=>'Disabled'])->default('true'),
                    Textarea::make('description')
                        ->label('Description')->rows(2)->columnSpanFull(),
                                ]),
                        ]),
                ]),

            Section::make('Record Info')
                ->description('System identifiers — read only.')
                ->icon('heroicon-o-information-circle')
                ->collapsed()->columns(3)
                ->schema([
                    Placeholder::make('device_vendor_uuid')
                        ->label('UUID')
                        ->content(fn ($record) => $record?->device_vendor_uuid
                            ? new HtmlString('<code style="font-family:monospace;font-size:0.72rem;color:#8b95ab;word-break:break-all;">'.$record->device_vendor_uuid.'</code>')
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
