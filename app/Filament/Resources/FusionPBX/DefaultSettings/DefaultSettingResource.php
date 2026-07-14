<?php

namespace App\Filament\Resources\FusionPBX\DefaultSettings;

use App\Filament\Resources\FusionPBX\DefaultSettings\Pages;
use App\Filament\Resources\FusionPBX\DefaultSettings\Schemas;
use App\Filament\Resources\FusionPBX\DefaultSettings\Tables;
use App\Models\FusionPBX\DefaultSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DefaultSettingResource extends Resource
{
    protected static ?string $slug = 'default-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-8-tooth';
    protected static ?int $navigationSort = 1;
protected static ?string $model = DefaultSetting::class;
    protected static ?string $modelLabel = 'Default Setting';

    protected static ?string $pluralModelLabel = 'Default Settings';

    protected static ?string $recordTitleAttribute = 'default_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DefaultSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DefaultSettingsTable::configure($table);
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
            'index' => Pages\ListDefaultSettings::route('/'),
            'create' => Pages\CreateDefaultSetting::route('/create'),
            'edit' => Pages\EditDefaultSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
