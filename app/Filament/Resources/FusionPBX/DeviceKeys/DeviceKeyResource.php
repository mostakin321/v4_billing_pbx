<?php

namespace App\Filament\Resources\FusionPBX\DeviceKeys;

use App\Filament\Resources\FusionPBX\DeviceKeys\Pages;
use App\Filament\Resources\FusionPBX\DeviceKeys\Schemas;
use App\Filament\Resources\FusionPBX\DeviceKeys\Tables;
use App\Models\FusionPBX\DeviceKey;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceKeyResource extends Resource
{
    protected static ?string $slug = 'device-key';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-key';
    protected static ?int $navigationSort = 3;
protected static ?string $model = DeviceKey::class;
    protected static ?string $modelLabel = 'Device Key';

    protected static ?string $pluralModelLabel = 'Device Keys';

    protected static ?string $recordTitleAttribute = 'device_key_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceKeyForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceKeysTable::configure($table);
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
            'index' => Pages\ListDeviceKeys::route('/'),
            'create' => Pages\CreateDeviceKey::route('/create'),
            'edit' => Pages\EditDeviceKey::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
