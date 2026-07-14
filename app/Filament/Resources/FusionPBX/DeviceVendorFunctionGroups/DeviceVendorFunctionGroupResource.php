<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Pages;
use App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Schemas;
use App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Tables;
use App\Models\FusionPBX\DeviceVendorFunctionGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceVendorFunctionGroupResource extends Resource
{
    protected static ?string $slug = 'device-vendor-function-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 11;
protected static ?string $model = DeviceVendorFunctionGroup::class;
    protected static ?string $modelLabel = 'Device Vendor Function Group';

    protected static ?string $pluralModelLabel = 'Device Vendor Function Groups';

    protected static ?string $recordTitleAttribute = 'device_vendor_function_group_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceVendorFunctionGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceVendorFunctionGroupsTable::configure($table);
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
            'index' => Pages\ListDeviceVendorFunctionGroups::route('/'),
            'create' => Pages\CreateDeviceVendorFunctionGroup::route('/create'),
            'edit' => Pages\EditDeviceVendorFunctionGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
