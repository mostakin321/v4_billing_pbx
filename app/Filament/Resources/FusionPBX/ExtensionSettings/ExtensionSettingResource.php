<?php

namespace App\Filament\Resources\FusionPBX\ExtensionSettings;

use App\Filament\Resources\FusionPBX\ExtensionSettings\Pages;
use App\Filament\Resources\FusionPBX\ExtensionSettings\Schemas;
use App\Filament\Resources\FusionPBX\ExtensionSettings\Tables;
use App\Models\FusionPBX\ExtensionSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ExtensionSettingResource extends Resource
{
    protected static ?string $slug = 'extension-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?int $navigationSort = 3;
protected static ?string $model = ExtensionSetting::class;
    protected static ?string $modelLabel = 'Extension Setting';

    protected static ?string $pluralModelLabel = 'Extension Settings';

    protected static ?string $recordTitleAttribute = 'extension_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ExtensionSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ExtensionSettingsTable::configure($table);
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
            'index' => Pages\ListExtensionSettings::route('/'),
            'create' => Pages\CreateExtensionSetting::route('/create'),
            'edit' => Pages\EditExtensionSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
