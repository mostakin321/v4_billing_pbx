<?php

namespace App\Filament\Resources\FusionPBX\MenuLanguages;

use App\Filament\Resources\FusionPBX\MenuLanguages\Pages;
use App\Filament\Resources\FusionPBX\MenuLanguages\Schemas;
use App\Filament\Resources\FusionPBX\MenuLanguages\Tables;
use App\Models\FusionPBX\MenuLanguage;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class MenuLanguageResource extends Resource
{
    protected static ?string $slug = 'menu-language';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-language';
    protected static ?int $navigationSort = 9;
protected static ?string $model = MenuLanguage::class;
    protected static ?string $modelLabel = 'Menu Language';

    protected static ?string $pluralModelLabel = 'Menu Languages';

    protected static ?string $recordTitleAttribute = 'menu_language_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\MenuLanguageForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\MenuLanguagesTable::configure($table);
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
            'index' => Pages\ListMenuLanguages::route('/'),
            'create' => Pages\CreateMenuLanguage::route('/create'),
            'edit' => Pages\EditMenuLanguage::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
