<?php

namespace App\Filament\Resources\Astpp\InvoiceConfResource;

use App\Filament\Resources\Astpp\InvoiceConfResource\Pages;
use App\Filament\Resources\Astpp\InvoiceConfResource\Schemas\InvoiceConfForm;
use App\Filament\Resources\Astpp\InvoiceConfResource\Tables\InvoiceConfTable;
use App\Models\Astpp\InvoiceConf;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class InvoiceConfResource extends Resource
{
    protected static ?string $model = InvoiceConf::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Invoice Conf'; }
    public static function getModelLabel(): string { return 'Invoice Conf'; }
    public static function getPluralModelLabel(): string { return 'Invoice Conf'; }
    public static function getNavigationSort(): ?int { return 29; }

    public static function form(Schema $schema): Schema
    {
        return InvoiceConfForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceConfTable::configure($table);
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
            'index' => Pages\ListInvoiceConfRecords::route('/'),
            'create' => Pages\CreateInvoiceConf::route('/create'),
            'edit' => Pages\EditInvoiceConf::route('/{record}/edit'),
        ];
    }
}
