<?php

namespace App\Filament\Resources\Astpp\AutomatedReportLogResource;

use App\Filament\Resources\Astpp\AutomatedReportLogResource\Pages;
use App\Filament\Resources\Astpp\AutomatedReportLogResource\Schemas\AutomatedReportLogForm;
use App\Filament\Resources\Astpp\AutomatedReportLogResource\Tables\AutomatedReportLogTable;
use App\Models\Astpp\AutomatedReportLog;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AutomatedReportLogResource extends Resource
{
    protected static ?string $model = AutomatedReportLog::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Automated Report Log'; }
    public static function getModelLabel(): string { return 'Automated Report Log'; }
    public static function getPluralModelLabel(): string { return 'Automated Report Log'; }
    public static function getNavigationSort(): ?int { return 9; }

    public static function form(Schema $schema): Schema
    {
        return AutomatedReportLogForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AutomatedReportLogTable::configure($table);
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
            'index' => Pages\ListAutomatedReportLogRecords::route('/'),
            'create' => Pages\CreateAutomatedReportLog::route('/create'),
            'edit' => Pages\EditAutomatedReportLog::route('/{record}/edit'),
        ];
    }
}
