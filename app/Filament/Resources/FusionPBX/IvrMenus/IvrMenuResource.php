<?php

namespace App\Filament\Resources\FusionPBX\IvrMenus;

use App\Filament\Resources\FusionPBX\IvrMenus\Pages;
use App\Filament\Resources\FusionPBX\IvrMenus\Schemas;
use App\Filament\Resources\FusionPBX\IvrMenus\Tables;
use App\Models\FusionPBX\IvrMenu;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class IvrMenuResource extends Resource
{
    protected static ?string $slug = 'ivr-menu';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-queue-list';
    protected static ?int $navigationSort = 1;
protected static ?string $model = IvrMenu::class;
    protected static ?string $modelLabel = 'Ivr Menu';

    protected static ?string $pluralModelLabel = 'Ivr Menus';

    protected static ?string $recordTitleAttribute = 'ivr_menu_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\IvrMenuForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\IvrMenusTable::configure($table);
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
            'index' => Pages\ListIvrMenus::route('/'),
            'create' => Pages\CreateIvrMenu::route('/create'),
            'edit' => Pages\EditIvrMenu::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
