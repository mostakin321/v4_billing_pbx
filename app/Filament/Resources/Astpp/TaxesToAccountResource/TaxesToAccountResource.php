<?php

namespace App\Filament\Resources\Astpp\TaxesToAccountResource;

use App\Filament\Resources\Astpp\TaxesToAccountResource\Pages;
use App\Filament\Resources\Astpp\TaxesToAccountResource\Schemas\TaxesToAccountForm;
use App\Filament\Resources\Astpp\TaxesToAccountResource\Tables\TaxesToAccountTable;
use App\Models\Astpp\TaxesToAccount;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class TaxesToAccountResource extends Resource
{
    protected static ?string $model = TaxesToAccount::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Taxes To Accounts'; }
    public static function getModelLabel(): string { return 'Taxes To Accounts'; }
    public static function getPluralModelLabel(): string { return 'Taxes To Accounts'; }
    public static function getNavigationSort(): ?int { return 64; }

    public static function form(Schema $schema): Schema
    {
        return TaxesToAccountForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TaxesToAccountTable::configure($table);
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
            'index' => Pages\ListTaxesToAccountRecords::route('/'),
            'create' => Pages\CreateTaxesToAccount::route('/create'),
            'edit' => Pages\EditTaxesToAccount::route('/{record}/edit'),
        ];
    }
}
