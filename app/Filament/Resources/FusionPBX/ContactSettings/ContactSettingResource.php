<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings;

use App\Filament\Resources\FusionPBX\ContactSettings\Pages;
use App\Filament\Resources\FusionPBX\ContactSettings\Schemas;
use App\Filament\Resources\FusionPBX\ContactSettings\Tables;
use App\Models\FusionPBX\ContactSetting;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ContactSettingResource extends Resource
{
    protected static ?string $slug = 'contact-setting';
    protected static \UnitEnum|string|null $navigationGroup = 'Contacts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-cog';
    protected static ?int $navigationSort = 8;
protected static ?string $model = ContactSetting::class;
    protected static ?string $modelLabel = 'Contact Setting';

    protected static ?string $pluralModelLabel = 'Contact Settings';

    protected static ?string $recordTitleAttribute = 'contact_setting_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\ContactSettingForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ContactSettingsTable::configure($table);
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
            'index' => Pages\ListContactSettings::route('/'),
            'create' => Pages\CreateContactSetting::route('/create'),
            'edit' => Pages\EditContactSetting::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Contacts';
    }

}
