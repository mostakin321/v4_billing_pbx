<?php

namespace App\Filament\Resources\FusionPBX\DomainSettings;

use App\Filament\Resources\FusionPBX\DomainSettings\Pages;
use App\Filament\Resources\FusionPBX\DomainSettings\Schemas;
use App\Filament\Resources\FusionPBX\DomainSettings\Tables;
use App\Models\FusionPBX\DomainSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class DomainSettingResource extends Resource
{
    protected static ?string $slug = 'domain-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-vertical';
    protected static ?int $navigationSort = 10;
protected static ?string $model = DomainSetting::class;
    protected static ?string $modelLabel = 'Domain Setting';

    protected static ?string $pluralModelLabel = 'Domain Settings';

    protected static ?string $recordTitleAttribute = 'domain_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\DomainSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\DomainSettingsTable::configure($table);
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
            'index' => Pages\ListDomainSettings::route('/'),
            'create' => Pages\CreateDomainSetting::route('/create'),
            'edit' => Pages\EditDomainSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
