<?php

namespace App\Filament\Resources\Astpp\CategoryResource;

use App\Filament\Resources\Astpp\CategoryResource\Pages;
use App\Filament\Resources\Astpp\CategoryResource\Schemas\CategoryForm;
use App\Filament\Resources\Astpp\CategoryResource\Tables\CategoryTable;
use App\Models\Astpp\Category;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Category'; }
    public static function getModelLabel(): string { return 'Category'; }
    public static function getPluralModelLabel(): string { return 'Category'; }
    public static function getNavigationSort(): ?int { return 13; }

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryTable::configure($table);
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
            'index' => Pages\ListCategoryRecords::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
