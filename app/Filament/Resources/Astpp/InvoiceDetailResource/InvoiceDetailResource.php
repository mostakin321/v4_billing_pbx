<?php

namespace App\Filament\Resources\Astpp\InvoiceDetailResource;

use App\Filament\Resources\Astpp\InvoiceDetailResource\Pages;
use App\Filament\Resources\Astpp\InvoiceDetailResource\Schemas\InvoiceDetailForm;
use App\Filament\Resources\Astpp\InvoiceDetailResource\Tables\InvoiceDetailTable;
use App\Models\Astpp\InvoiceDetail;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class InvoiceDetailResource extends Resource
{
    protected static ?string $model = InvoiceDetail::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Invoice Details'; }
    public static function getModelLabel(): string { return 'Invoice Details'; }
    public static function getPluralModelLabel(): string { return 'Invoice Details'; }
    public static function getNavigationSort(): ?int { return 30; }

    public static function form(Schema $schema): Schema
    {
        return InvoiceDetailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InvoiceDetailTable::configure($table);
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
            'index' => Pages\ListInvoiceDetailRecords::route('/'),
            'create' => Pages\CreateInvoiceDetail::route('/create'),
            'edit' => Pages\EditInvoiceDetail::route('/{record}/edit'),
        ];
    }
}
