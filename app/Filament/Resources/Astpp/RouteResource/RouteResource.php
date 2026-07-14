<?php

namespace App\Filament\Resources\Astpp\RouteResource;

use App\Filament\Resources\Astpp\RouteResource\Pages;
use App\Filament\Resources\Astpp\RouteResource\Schemas\RouteForm;
use App\Filament\Resources\Astpp\RouteResource\Tables\RouteTable;
use App\Models\Astpp\Route;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class RouteResource extends Resource
{
    protected static ?string $model = Route::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Routing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Routes'; }
    public static function getModelLabel(): string { return 'Routes'; }
    public static function getPluralModelLabel(): string { return 'Routes'; }
    public static function getNavigationSort(): ?int { return 56; }

    public static function form(Schema $schema): Schema
    {
        return RouteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RouteTable::configure($table);
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
            'index' => Pages\ListRouteRecords::route('/'),
            'create' => Pages\CreateRoute::route('/create'),
            'edit' => Pages\EditRoute::route('/{record}/edit'),
        ];
    }
}
