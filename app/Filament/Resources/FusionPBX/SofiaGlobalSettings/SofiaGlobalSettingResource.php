<?php

namespace App\Filament\Resources\FusionPBX\SofiaGlobalSettings;

use App\Filament\Resources\FusionPBX\SofiaGlobalSettings\Pages;
use App\Filament\Resources\FusionPBX\SofiaGlobalSettings\Schemas;
use App\Filament\Resources\FusionPBX\SofiaGlobalSettings\Tables;
use App\Models\FusionPBX\SofiaGlobalSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class SofiaGlobalSettingResource extends Resource
{
    protected static ?string $slug = 'sofia-global-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?int $navigationSort = 5;
protected static ?string $model = SofiaGlobalSetting::class;
    protected static ?string $modelLabel = 'Sofia Global Setting';

    protected static ?string $pluralModelLabel = 'Sofia Global Settings';

    protected static ?string $recordTitleAttribute = 'sofia_global_setting_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\SofiaGlobalSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\SofiaGlobalSettingsTable::configure($table);
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
            'index' => Pages\ListSofiaGlobalSettings::route('/'),
            'create' => Pages\CreateSofiaGlobalSetting::route('/create'),
            'edit' => Pages\EditSofiaGlobalSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
