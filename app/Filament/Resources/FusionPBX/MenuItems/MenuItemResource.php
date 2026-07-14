<?php

namespace App\Filament\Resources\FusionPBX\MenuItems;

use App\Filament\Resources\FusionPBX\MenuItems\Pages;
use App\Filament\Resources\FusionPBX\MenuItems\Schemas;
use App\Filament\Resources\FusionPBX\MenuItems\Tables;
use App\Models\FusionPBX\MenuItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $slug = 'menu-item';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?int $navigationSort = 7;
protected static ?string $model = MenuItem::class;
    protected static ?string $modelLabel = 'Menu Item';

    protected static ?string $pluralModelLabel = 'Menu Items';

    protected static ?string $recordTitleAttribute = 'menu_item_description';

    public static function form(Schema $form): Schema
    {
        return Schemas\MenuItemForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\MenuItemsTable::configure($table);
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
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
