<?php

namespace App\Filament\Resources\Astpp\ActivityReportResource;

use App\Filament\Resources\Astpp\ActivityReportResource\Pages;
use App\Filament\Resources\Astpp\ActivityReportResource\Schemas\ActivityReportForm;
use App\Filament\Resources\Astpp\ActivityReportResource\Tables\ActivityReportTable;
use App\Models\Astpp\ActivityReport;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ActivityReportResource extends Resource
{
    protected static ?string $model = ActivityReport::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Reports'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationLabel(): string { return 'Activity Reports'; }
    public static function getModelLabel(): string { return 'Activity Reports'; }
    public static function getPluralModelLabel(): string { return 'Activity Reports'; }
    public static function getNavigationSort(): ?int { return 6; }

    public static function form(Schema $schema): Schema
    {
        return ActivityReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActivityReportTable::configure($table);
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
            'index' => Pages\ListActivityReportRecords::route('/'),
            'create' => Pages\CreateActivityReport::route('/create'),
            'edit' => Pages\EditActivityReport::route('/{record}/edit'),
        ];
    }
}
