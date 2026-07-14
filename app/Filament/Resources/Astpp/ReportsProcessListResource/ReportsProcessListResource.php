<?php

namespace App\Filament\Resources\Astpp\ReportsProcessListResource;

use App\Filament\Resources\Astpp\ReportsProcessListResource\Pages;
use App\Filament\Resources\Astpp\ReportsProcessListResource\Schemas\ReportsProcessListForm;
use App\Filament\Resources\Astpp\ReportsProcessListResource\Tables\ReportsProcessListTable;
use App\Models\Astpp\ReportsProcessList;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ReportsProcessListResource extends Resource
{
    protected static ?string $model = ReportsProcessList::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Reports Process List'; }
    public static function getModelLabel(): string { return 'Reports Process List'; }
    public static function getPluralModelLabel(): string { return 'Reports Process List'; }
    public static function getNavigationSort(): ?int { return 52; }

    public static function form(Schema $schema): Schema
    {
        return ReportsProcessListForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReportsProcessListTable::configure($table);
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
            'index' => Pages\ListReportsProcessListRecords::route('/'),
            'create' => Pages\CreateReportsProcessList::route('/create'),
            'edit' => Pages\EditReportsProcessList::route('/{record}/edit'),
        ];
    }
}
