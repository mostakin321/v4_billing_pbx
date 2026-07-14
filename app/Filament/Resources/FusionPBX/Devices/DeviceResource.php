<?php

namespace App\Filament\Resources\FusionPBX\Devices;

use App\Filament\Resources\FusionPBX\Devices\Pages;
use App\Filament\Resources\FusionPBX\Devices\Schemas;
use App\Filament\Resources\FusionPBX\Devices\Tables;
use App\Models\FusionPBX\Device;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceResource extends Resource
{
    protected static ?string $slug = 'device';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-device-phone-mobile';
    protected static ?int $navigationSort = 1;
protected static ?string $model = Device::class;
    protected static ?string $modelLabel = 'Device';

    protected static ?string $pluralModelLabel = 'Devices';

    protected static ?string $recordTitleAttribute = 'device_description';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DevicesTable::configure($table);
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
            'index' => Pages\ListDevices::route('/'),
            'create' => Pages\CreateDevice::route('/create'),
            'edit' => Pages\EditDevice::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
