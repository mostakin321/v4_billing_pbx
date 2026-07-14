<?php

namespace App\Filament\Resources\FusionPBX\SipProfileSettings;

use App\Filament\Resources\FusionPBX\SipProfileSettings\Pages;
use App\Filament\Resources\FusionPBX\SipProfileSettings\Schemas;
use App\Filament\Resources\FusionPBX\SipProfileSettings\Tables;
use App\Models\FusionPBX\SipProfileSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class SipProfileSettingResource extends Resource
{
    protected static ?string $slug = 'sip-profile-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'SIP & Gateways';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?int $navigationSort = 3;
protected static ?string $model = SipProfileSetting::class;
    protected static ?string $modelLabel = 'Sip Profile Setting';

    protected static ?string $pluralModelLabel = 'Sip Profile Settings';

    protected static ?string $recordTitleAttribute = 'sip_profile_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\SipProfileSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\SipProfileSettingsTable::configure($table);
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
            'index' => Pages\ListSipProfileSettings::route('/'),
            'create' => Pages\CreateSipProfileSetting::route('/create'),
            'edit' => Pages\EditSipProfileSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'SIP & Gateways';
    }

}
