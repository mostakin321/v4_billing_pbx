<?php

namespace App\Filament\Resources\FusionPBX\UserSettings;

use App\Filament\Resources\FusionPBX\UserSettings\Pages;
use App\Filament\Resources\FusionPBX\UserSettings\Schemas;
use App\Filament\Resources\FusionPBX\UserSettings\Tables;
use App\Models\FusionPBX\UserSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class UserSettingResource extends Resource
{
    protected static ?string $slug = 'user-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?int $navigationSort = 7;
protected static ?string $model = UserSetting::class;
    protected static ?string $modelLabel = 'User Setting';

    protected static ?string $pluralModelLabel = 'User Settings';

    protected static ?string $recordTitleAttribute = 'user_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\UserSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\UserSettingsTable::configure($table);
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
            'index' => Pages\ListUserSettings::route('/'),
            'create' => Pages\CreateUserSetting::route('/create'),
            'edit' => Pages\EditUserSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
