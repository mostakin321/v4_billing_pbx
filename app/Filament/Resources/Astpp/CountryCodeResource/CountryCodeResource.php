<?php

namespace App\Filament\Resources\Astpp\CountryCodeResource;

use App\Filament\Resources\Astpp\CountryCodeResource\Pages;
use App\Filament\Resources\Astpp\CountryCodeResource\Schemas\CountryCodeForm;
use App\Filament\Resources\Astpp\CountryCodeResource\Tables\CountryCodeTable;
use App\Models\Astpp\CountryCode;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CountryCodeResource extends Resource
{
    protected static ?string $model = CountryCode::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Countrycode'; }
    public static function getModelLabel(): string { return 'Countrycode'; }
    public static function getPluralModelLabel(): string { return 'Countrycode'; }
    public static function getNavigationSort(): ?int { return 21; }

    public static function form(Schema $schema): Schema
    {
        return CountryCodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CountryCodeTable::configure($table);
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
            'index' => Pages\ListCountryCodeRecords::route('/'),
            'create' => Pages\CreateCountryCode::route('/create'),
            'edit' => Pages\EditCountryCode::route('/{record}/edit'),
        ];
    }
}
