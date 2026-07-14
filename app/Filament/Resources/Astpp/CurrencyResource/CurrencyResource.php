<?php

namespace App\Filament\Resources\Astpp\CurrencyResource;

use App\Filament\Resources\Astpp\CurrencyResource\Pages;
use App\Filament\Resources\Astpp\CurrencyResource\Schemas\CurrencyForm;
use App\Filament\Resources\Astpp\CurrencyResource\Tables\CurrencyTable;
use App\Models\Astpp\Currency;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CurrencyResource extends Resource
{
    protected static ?string $model = Currency::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Currency'; }
    public static function getModelLabel(): string { return 'Currency'; }
    public static function getPluralModelLabel(): string { return 'Currency'; }
    public static function getNavigationSort(): ?int { return 23; }

    public static function form(Schema $schema): Schema
    {
        return CurrencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CurrencyTable::configure($table);
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
            'index' => Pages\ListCurrencyRecords::route('/'),
            'create' => Pages\CreateCurrency::route('/create'),
            'edit' => Pages\EditCurrency::route('/{record}/edit'),
        ];
    }
}
