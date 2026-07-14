<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileKeys;

use App\Filament\Resources\FusionPBX\DeviceProfileKeys\Pages;
use App\Filament\Resources\FusionPBX\DeviceProfileKeys\Schemas;
use App\Filament\Resources\FusionPBX\DeviceProfileKeys\Tables;
use App\Models\FusionPBX\DeviceProfileKey;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceProfileKeyResource extends Resource
{
    protected static ?string $slug = 'device-profile-key';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';
    protected static ?int $navigationSort = 7;
protected static ?string $model = DeviceProfileKey::class;
    protected static ?string $modelLabel = 'Device Profile Key';

    protected static ?string $pluralModelLabel = 'Device Profile Keys';

    protected static ?string $recordTitleAttribute = 'device_profile_key_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceProfileKeyForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceProfileKeysTable::configure($table);
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
            'index' => Pages\ListDeviceProfileKeys::route('/'),
            'create' => Pages\CreateDeviceProfileKey::route('/create'),
            'edit' => Pages\EditDeviceProfileKey::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
