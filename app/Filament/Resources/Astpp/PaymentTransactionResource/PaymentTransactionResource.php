<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource;

use App\Filament\Resources\Astpp\PaymentTransactionResource\Pages;
use App\Filament\Resources\Astpp\PaymentTransactionResource\Schemas\PaymentTransactionForm;
use App\Filament\Resources\Astpp\PaymentTransactionResource\Tables\PaymentTransactionTable;
use App\Models\Astpp\PaymentTransaction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class PaymentTransactionResource extends Resource
{
    protected static ?string $model = PaymentTransaction::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Billing'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Payment Transaction'; }
    public static function getModelLabel(): string { return 'Payment Transaction'; }
    public static function getPluralModelLabel(): string { return 'Payment Transaction'; }
    public static function getNavigationSort(): ?int { return 44; }

    public static function form(Schema $schema): Schema
    {
        return PaymentTransactionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PaymentTransactionTable::configure($table);
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
            'index' => Pages\ListPaymentTransactionRecords::route('/'),
            'create' => Pages\CreatePaymentTransaction::route('/create'),
            'edit' => Pages\EditPaymentTransaction::route('/{record}/edit'),
        ];
    }
}
