<?php

namespace App\Filament\Resources\FusionPBX\Menus;

use App\Filament\Resources\FusionPBX\Menus\Pages;
use App\Filament\Resources\FusionPBX\Menus\Schemas;
use App\Filament\Resources\FusionPBX\Menus\Tables;
use App\Models\FusionPBX\Menu;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class MenuResource extends Resource
{
    protected static ?string $slug = 'menu';
    protected static \UnitEnum|string|null $navigationGroup = 'Advanced';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-bars-3';
    protected static ?int $navigationSort = 6;
protected static ?string $model = Menu::class;
    protected static ?string $modelLabel = 'Menu';

    protected static ?string $pluralModelLabel = 'Menus';

    protected static ?string $recordTitleAttribute = 'menu_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\MenuForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\MenusTable::configure($table);
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'System';
    }

}
