<?php

namespace App\Filament\Resources\Astpp\MenuModuleResource;

use App\Filament\Resources\Astpp\MenuModuleResource\Pages;
use App\Filament\Resources\Astpp\MenuModuleResource\Schemas\MenuModuleForm;
use App\Filament\Resources\Astpp\MenuModuleResource\Tables\MenuModuleTable;
use App\Models\Astpp\MenuModule;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class MenuModuleResource extends Resource
{
    protected static ?string $model = MenuModule::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Menu Modules'; }
    public static function getModelLabel(): string { return 'Menu Modules'; }
    public static function getPluralModelLabel(): string { return 'Menu Modules'; }
    public static function getNavigationSort(): ?int { return 39; }

    public static function form(Schema $schema): Schema
    {
        return MenuModuleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MenuModuleTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {
            $query->where('deleted', 0);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuModuleRecords::route('/'),
            'create' => Pages\CreateMenuModule::route('/create'),
            'edit' => Pages\EditMenuModule::route('/{record}/edit'),
        ];
    }
}
