<?php

namespace App\Filament\Resources\Astpp\AccountsCdrSummaryResource;

use App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Pages;
use App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Schemas\AccountsCdrSummaryForm;
use App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Tables\AccountsCdrSummaryTable;
use App\Models\Astpp\AccountsCdrSummary;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AccountsCdrSummaryResource extends Resource
{
    protected static ?string $model = AccountsCdrSummary::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP CDR'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Accounts CDR Summary'; }
    public static function getModelLabel(): string { return 'Accounts CDR Summary'; }
    public static function getPluralModelLabel(): string { return 'Accounts CDR Summary'; }
    public static function getNavigationSort(): ?int { return 5; }

    public static function form(Schema $schema): Schema
    {
        return AccountsCdrSummaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccountsCdrSummaryTable::configure($table);
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
            'index' => Pages\ListAccountsCdrSummaryRecords::route('/'),
            'create' => Pages\CreateAccountsCdrSummary::route('/create'),
            'edit' => Pages\EditAccountsCdrSummary::route('/{record}/edit'),
        ];
    }
}
