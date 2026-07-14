<?php

namespace App\Filament\Resources\Astpp\CounterResource;

use App\Filament\Resources\Astpp\CounterResource\Pages;
use App\Filament\Resources\Astpp\CounterResource\Schemas\CounterForm;
use App\Filament\Resources\Astpp\CounterResource\Tables\CounterTable;
use App\Models\Astpp\Counter;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CounterResource extends Resource
{
    protected static ?string $model = Counter::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Products'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'Counters'; }
    public static function getModelLabel(): string { return 'Counters'; }
    public static function getPluralModelLabel(): string { return 'Counters'; }
    public static function getNavigationSort(): ?int { return 20; }

    public static function form(Schema $schema): Schema
    {
        return CounterForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CounterTable::configure($table);
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
            'index' => Pages\ListCounterRecords::route('/'),
            'create' => Pages\CreateCounter::route('/create'),
            'edit' => Pages\EditCounter::route('/{record}/edit'),
        ];
    }
}
