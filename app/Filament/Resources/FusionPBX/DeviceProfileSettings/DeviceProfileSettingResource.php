<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileSettings;

use App\Filament\Resources\FusionPBX\DeviceProfileSettings\Pages;
use App\Filament\Resources\FusionPBX\DeviceProfileSettings\Schemas;
use App\Filament\Resources\FusionPBX\DeviceProfileSettings\Tables;
use App\Models\FusionPBX\DeviceProfileSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceProfileSettingResource extends Resource
{
    protected static ?string $slug = 'device-profile-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?int $navigationSort = 8;
protected static ?string $model = DeviceProfileSetting::class;
    protected static ?string $modelLabel = 'Device Profile Setting';

    protected static ?string $pluralModelLabel = 'Device Profile Settings';

    protected static ?string $recordTitleAttribute = 'device_profile_setting_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceProfileSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceProfileSettingsTable::configure($table);
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
            'index' => Pages\ListDeviceProfileSettings::route('/'),
            'create' => Pages\CreateDeviceProfileSetting::route('/create'),
            'edit' => Pages\EditDeviceProfileSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
