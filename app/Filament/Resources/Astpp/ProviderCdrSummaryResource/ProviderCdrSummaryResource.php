<?php

namespace App\Filament\Resources\Astpp\ProviderCdrSummaryResource;

use App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Pages;
use App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Schemas\ProviderCdrSummaryForm;
use App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Tables\ProviderCdrSummaryTable;
use App\Models\Astpp\ProviderCdrSummary;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ProviderCdrSummaryResource extends Resource
{
    protected static ?string $model = ProviderCdrSummary::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP CDR'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Provider CDR Summary'; }
    public static function getModelLabel(): string { return 'Provider CDR Summary'; }
    public static function getPluralModelLabel(): string { return 'Provider CDR Summary'; }
    public static function getNavigationSort(): ?int { return 48; }

    public static function form(Schema $schema): Schema
    {
        return ProviderCdrSummaryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProviderCdrSummaryTable::configure($table);
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
            'index' => Pages\ListProviderCdrSummaryRecords::route('/'),
            'create' => Pages\CreateProviderCdrSummary::route('/create'),
            'edit' => Pages\EditProviderCdrSummary::route('/{record}/edit'),
        ];
    }
}
