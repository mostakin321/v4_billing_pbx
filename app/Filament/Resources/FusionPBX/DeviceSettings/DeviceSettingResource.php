<?php

namespace App\Filament\Resources\FusionPBX\DeviceSettings;

use App\Filament\Resources\FusionPBX\DeviceSettings\Pages;
use App\Filament\Resources\FusionPBX\DeviceSettings\Schemas;
use App\Filament\Resources\FusionPBX\DeviceSettings\Tables;
use App\Models\FusionPBX\DeviceSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceSettingResource extends Resource
{
    protected static ?string $slug = 'device-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 4;
protected static ?string $model = DeviceSetting::class;
    protected static ?string $modelLabel = 'Device Setting';

    protected static ?string $pluralModelLabel = 'Device Settings';

    protected static ?string $recordTitleAttribute = 'device_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceSettingsTable::configure($table);
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
            'index' => Pages\ListDeviceSettings::route('/'),
            'create' => Pages\CreateDeviceSetting::route('/create'),
            'edit' => Pages\EditDeviceSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
