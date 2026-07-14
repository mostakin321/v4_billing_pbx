<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfiles;

use App\Filament\Resources\FusionPBX\DeviceProfiles\Pages;
use App\Filament\Resources\FusionPBX\DeviceProfiles\Schemas;
use App\Filament\Resources\FusionPBX\DeviceProfiles\Tables;
use App\Models\FusionPBX\DeviceProfile;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DeviceProfileResource extends Resource
{
    protected static ?string $slug = 'device-profile';
    protected static \UnitEnum|string|null $navigationGroup = 'Devices';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-identification';
    protected static ?int $navigationSort = 6;
protected static ?string $model = DeviceProfile::class;
    protected static ?string $modelLabel = 'Device Profile';

    protected static ?string $pluralModelLabel = 'Device Profiles';

    protected static ?string $recordTitleAttribute = 'device_profile_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DeviceProfileForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DeviceProfilesTable::configure($table);
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
            'index' => Pages\ListDeviceProfiles::route('/'),
            'create' => Pages\CreateDeviceProfile::route('/create'),
            'edit' => Pages\EditDeviceProfile::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Devices';
    }

}
