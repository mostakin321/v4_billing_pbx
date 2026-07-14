<?php

namespace App\Filament\Resources\FusionPBX\IvrMenuOptions;

use App\Filament\Resources\FusionPBX\IvrMenuOptions\Pages;
use App\Filament\Resources\FusionPBX\IvrMenuOptions\Schemas;
use App\Filament\Resources\FusionPBX\IvrMenuOptions\Tables;
use App\Models\FusionPBX\IvrMenuOption;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class IvrMenuOptionResource extends Resource
{
    protected static ?string $slug = 'ivr-menu-option';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-list-bullet';
    protected static ?int $navigationSort = 2;
protected static ?string $model = IvrMenuOption::class;
    protected static ?string $modelLabel = 'Ivr Menu Option';

    protected static ?string $pluralModelLabel = 'Ivr Menu Options';

    protected static ?string $recordTitleAttribute = 'ivr_menu_option_description';

    public static function form(Schema $form): Schema
    {
        return Schemas\IvrMenuOptionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\IvrMenuOptionsTable::configure($table);
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
            'index' => Pages\ListIvrMenuOptions::route('/'),
            'create' => Pages\CreateIvrMenuOption::route('/create'),
            'edit' => Pages\EditIvrMenuOption::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
