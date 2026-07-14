<?php

namespace App\Filament\Resources\Astpp\ResellerProductResource;

use App\Filament\Resources\Astpp\ResellerProductResource\Pages;
use App\Filament\Resources\Astpp\ResellerProductResource\Schemas\ResellerProductForm;
use App\Filament\Resources\Astpp\ResellerProductResource\Tables\ResellerProductTable;
use App\Models\Astpp\ResellerProduct;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ResellerProductResource extends Resource
{
    protected static ?string $model = ResellerProduct::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Products'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Reseller Products'; }
    public static function getModelLabel(): string { return 'Reseller Products'; }
    public static function getPluralModelLabel(): string { return 'Reseller Products'; }
    public static function getNavigationSort(): ?int { return 54; }

    public static function form(Schema $schema): Schema
    {
        return ResellerProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResellerProductTable::configure($table);
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
            'index' => Pages\ListResellerProductRecords::route('/'),
            'create' => Pages\CreateResellerProduct::route('/create'),
            'edit' => Pages\EditResellerProduct::route('/{record}/edit'),
        ];
    }
}
