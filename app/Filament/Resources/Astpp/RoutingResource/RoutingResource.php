<?php

namespace App\Filament\Resources\Astpp\RoutingResource;

use App\Filament\Resources\Astpp\RoutingResource\Pages;
use App\Filament\Resources\Astpp\RoutingResource\Schemas\RoutingForm;
use App\Filament\Resources\Astpp\RoutingResource\Tables\RoutingTable;
use App\Models\Astpp\Routing;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class RoutingResource extends Resource
{
    protected static ?string $model = Routing::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Routing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Routing'; }
    public static function getModelLabel(): string { return 'Routing'; }
    public static function getPluralModelLabel(): string { return 'Routing'; }
    public static function getNavigationSort(): ?int { return 57; }

    public static function form(Schema $schema): Schema
    {
        return RoutingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RoutingTable::configure($table);
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
            'index' => Pages\ListRoutingRecords::route('/'),
            'create' => Pages\CreateRouting::route('/create'),
            'edit' => Pages\EditRouting::route('/{record}/edit'),
        ];
    }
}
