<?php

namespace App\Filament\Resources\FusionPBX\DeviceLines;

use App\Filament\Resources\FusionPBX\DeviceLines\Pages;
use App\Filament\Resources\FusionPBX\DeviceLines\Schemas;
use App\Filament\Resources\FusionPBX\DeviceLines\Tables;
use App\Models\FusionPBX\DeviceLine;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceLineResource extends Resource
{
    protected static ?string $slug = 'device-line';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-signal';
    protected static ?int $navigationSort = 2;
protected static ?string $model = DeviceLine::class;
    protected static ?string $modelLabel = 'Device Line';

    protected static ?string $pluralModelLabel = 'Device Lines';

    protected static ?string $recordTitleAttribute = 'label';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceLineForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceLinesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDeviceLines::route('/'),
            'create' => Pages\CreateDeviceLine::route('/create'),
            'edit' => Pages\EditDeviceLine::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
