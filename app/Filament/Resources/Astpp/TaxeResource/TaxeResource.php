<?php

namespace App\Filament\Resources\Astpp\TaxeResource;

use App\Filament\Resources\Astpp\TaxeResource\Pages;
use App\Filament\Resources\Astpp\TaxeResource\Schemas\TaxeForm;
use App\Filament\Resources\Astpp\TaxeResource\Tables\TaxeTable;
use App\Models\Astpp\Taxe;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class TaxeResource extends Resource
{
    protected static ?string $model = Taxe::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Taxes'; }
    public static function getModelLabel(): string { return 'Taxes'; }
    public static function getPluralModelLabel(): string { return 'Taxes'; }
    public static function getNavigationSort(): ?int { return 63; }

    public static function form(Schema $schema): Schema
    {
        return TaxeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxeTable::configure($table);
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
            'index' => Pages\ListTaxeRecords::route('/'),
            'create' => Pages\CreateTaxe::route('/create'),
            'edit' => Pages\EditTaxe::route('/{record}/edit'),
        ];
    }
}
