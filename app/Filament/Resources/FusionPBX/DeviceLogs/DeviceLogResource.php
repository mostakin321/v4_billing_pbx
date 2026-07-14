<?php

namespace App\Filament\Resources\FusionPBX\DeviceLogs;

use App\Filament\Resources\FusionPBX\DeviceLogs\Pages;
use App\Filament\Resources\FusionPBX\DeviceLogs\Schemas;
use App\Filament\Resources\FusionPBX\DeviceLogs\Tables;
use App\Models\FusionPBX\DeviceLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceLogResource extends Resource
{
    protected static ?string $slug = 'device-log';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?int $navigationSort = 5;
protected static ?string $model = DeviceLog::class;
    protected static ?string $modelLabel = 'Device Log';

    protected static ?string $pluralModelLabel = 'Device Logs';

    protected static ?string $recordTitleAttribute = 'device_log_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceLogForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceLogsTable::configure($table);
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
            'index' => Pages\ListDeviceLogs::route('/'),
            'create' => Pages\CreateDeviceLog::route('/create'),
            'edit' => Pages\EditDeviceLog::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
