<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctions;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Pages;
use App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Schemas;
use App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Tables;
use App\Models\FusionPBX\DeviceVendorFunction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceVendorFunctionResource extends Resource
{
    protected static ?string $slug = 'device-vendor-function';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?int $navigationSort = 10;
protected static ?string $model = DeviceVendorFunction::class;
    protected static ?string $modelLabel = 'Device Vendor Function';

    protected static ?string $pluralModelLabel = 'Device Vendor Functions';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceVendorFunctionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceVendorFunctionsTable::configure($table);
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
            'index' => Pages\ListDeviceVendorFunctions::route('/'),
            'create' => Pages\CreateDeviceVendorFunction::route('/create'),
            'edit' => Pages\EditDeviceVendorFunction::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
