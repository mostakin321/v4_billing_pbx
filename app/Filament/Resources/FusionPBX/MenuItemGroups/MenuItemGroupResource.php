<?php

namespace App\Filament\Resources\FusionPBX\MenuItemGroups;

use App\Filament\Resources\FusionPBX\MenuItemGroups\Pages;
use App\Filament\Resources\FusionPBX\MenuItemGroups\Schemas;
use App\Filament\Resources\FusionPBX\MenuItemGroups\Tables;
use App\Models\FusionPBX\MenuItemGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class MenuItemGroupResource extends Resource
{
    protected static ?string $slug = 'menu-item-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?int $navigationSort = 8;
protected static ?string $model = MenuItemGroup::class;
    protected static ?string $modelLabel = 'Menu Item Group';

    protected static ?string $pluralModelLabel = 'Menu Item Groups';

    protected static ?string $recordTitleAttribute = 'menu_item_group_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\MenuItemGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\MenuItemGroupsTable::configure($table);
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
            'index' => Pages\ListMenuItemGroups::route('/'),
            'create' => Pages\CreateMenuItemGroup::route('/create'),
            'edit' => Pages\EditMenuItemGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
