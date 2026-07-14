<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendors;

use App\Filament\Resources\FusionPBX\DeviceVendors\Pages;
use App\Filament\Resources\FusionPBX\DeviceVendors\Schemas;
use App\Filament\Resources\FusionPBX\DeviceVendors\Tables;
use App\Models\FusionPBX\DeviceVendor;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceVendorResource extends Resource
{
    protected static ?string $slug = 'device-vendor';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?int $navigationSort = 9;
protected static ?string $model = DeviceVendor::class;
    protected static ?string $modelLabel = 'Device Vendor';

    protected static ?string $pluralModelLabel = 'Device Vendors';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceVendorForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceVendorsTable::configure($table);
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
            'index' => Pages\ListDeviceVendors::route('/'),
            'create' => Pages\CreateDeviceVendor::route('/create'),
            'edit' => Pages\EditDeviceVendor::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
