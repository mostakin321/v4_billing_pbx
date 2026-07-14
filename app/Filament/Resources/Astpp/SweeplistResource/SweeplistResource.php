<?php

namespace App\Filament\Resources\Astpp\SweeplistResource;

use App\Filament\Resources\Astpp\SweeplistResource\Pages;
use App\Filament\Resources\Astpp\SweeplistResource\Schemas\SweeplistForm;
use App\Filament\Resources\Astpp\SweeplistResource\Tables\SweeplistTable;
use App\Models\Astpp\Sweeplist;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class SweeplistResource extends Resource
{
    protected static ?string $model = Sweeplist::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Sweeplist'; }
    public static function getModelLabel(): string { return 'Sweeplist'; }
    public static function getPluralModelLabel(): string { return 'Sweeplist'; }
    public static function getNavigationSort(): ?int { return 61; }

    public static function form(Schema $schema): Schema
    {
        return SweeplistForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SweeplistTable::configure($table);
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
            'index' => Pages\ListSweeplistRecords::route('/'),
            'create' => Pages\CreateSweeplist::route('/create'),
            'edit' => Pages\EditSweeplist::route('/{record}/edit'),
        ];
    }
}
