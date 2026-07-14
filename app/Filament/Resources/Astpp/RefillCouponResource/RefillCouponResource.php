<?php

namespace App\Filament\Resources\Astpp\RefillCouponResource;

use App\Filament\Resources\Astpp\RefillCouponResource\Pages;
use App\Filament\Resources\Astpp\RefillCouponResource\Schemas\RefillCouponForm;
use App\Filament\Resources\Astpp\RefillCouponResource\Tables\RefillCouponTable;
use App\Models\Astpp\RefillCoupon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class RefillCouponResource extends Resource
{
    protected static ?string $model = RefillCoupon::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Refill Coupon'; }
    public static function getModelLabel(): string { return 'Refill Coupon'; }
    public static function getPluralModelLabel(): string { return 'Refill Coupon'; }
    public static function getNavigationSort(): ?int { return 51; }

    public static function form(Schema $schema): Schema
    {
        return RefillCouponForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RefillCouponTable::configure($table);
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
            'index' => Pages\ListRefillCouponRecords::route('/'),
            'create' => Pages\CreateRefillCoupon::route('/create'),
            'edit' => Pages\EditRefillCoupon::route('/{record}/edit'),
        ];
    }
}
