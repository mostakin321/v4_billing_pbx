<?php

namespace App\Filament\Resources\Astpp\CdrsDayBySummaryResource;

use App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Pages;
use App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Schemas\CdrsDayBySummaryForm;
use App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Tables\CdrsDayBySummaryTable;
use App\Models\Astpp\CdrsDayBySummary;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CdrsDayBySummaryResource extends Resource
{
    protected static ?string $model = CdrsDayBySummary::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP CDR'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'CDRs Day By Summary'; }
    public static function getModelLabel(): string { return 'CDRs Day By Summary'; }
    public static function getPluralModelLabel(): string { return 'CDRs Day By Summary'; }
    public static function getNavigationSort(): ?int { return 15; }

    public static function form(Schema $schema): Schema
    {
        return CdrsDayBySummaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CdrsDayBySummaryTable::configure($table);
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
            'index' => Pages\ListCdrsDayBySummaryRecords::route('/'),
            'create' => Pages\CreateCdrsDayBySummary::route('/create'),
            'edit' => Pages\EditCdrsDayBySummary::route('/{record}/edit'),
        ];
    }
}
