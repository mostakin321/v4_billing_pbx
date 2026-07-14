<?php

namespace App\Filament\Resources\Astpp\OrderItemResource;

use App\Filament\Resources\Astpp\OrderItemResource\Pages;
use App\Filament\Resources\Astpp\OrderItemResource\Schemas\OrderItemForm;
use App\Filament\Resources\Astpp\OrderItemResource\Tables\OrderItemTable;
use App\Models\Astpp\OrderItem;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class OrderItemResource extends Resource
{
    protected static ?string $model = OrderItem::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Products'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Order Items'; }
    public static function getModelLabel(): string { return 'Order Items'; }
    public static function getPluralModelLabel(): string { return 'Order Items'; }
    public static function getNavigationSort(): ?int { return 40; }

    public static function form(Schema $schema): Schema
    {
        return OrderItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrderItemTable::configure($table);
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
            'index' => Pages\ListOrderItemRecords::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
