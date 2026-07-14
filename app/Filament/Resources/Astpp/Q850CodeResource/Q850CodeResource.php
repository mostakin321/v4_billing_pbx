<?php

namespace App\Filament\Resources\Astpp\Q850CodeResource;

use App\Filament\Resources\Astpp\Q850CodeResource\Pages;
use App\Filament\Resources\Astpp\Q850CodeResource\Schemas\Q850CodeForm;
use App\Filament\Resources\Astpp\Q850CodeResource\Tables\Q850CodeTable;
use App\Models\Astpp\Q850Code;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class Q850CodeResource extends Resource
{
    protected static ?string $model = Q850Code::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Q850Code'; }
    public static function getModelLabel(): string { return 'Q850Code'; }
    public static function getPluralModelLabel(): string { return 'Q850Code'; }
    public static function getNavigationSort(): ?int { return 49; }

    public static function form(Schema $schema): Schema
    {
        return Q850CodeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return Q850CodeTable::configure($table);
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
            'index' => Pages\ListQ850CodeRecords::route('/'),
            'create' => Pages\CreateQ850Code::route('/create'),
            'edit' => Pages\EditQ850Code::route('/{record}/edit'),
        ];
    }
}
