<?php

namespace App\Filament\Resources\Astpp\CiSessionResource;

use App\Filament\Resources\Astpp\CiSessionResource\Pages;
use App\Filament\Resources\Astpp\CiSessionResource\Schemas\CiSessionForm;
use App\Filament\Resources\Astpp\CiSessionResource\Tables\CiSessionTable;
use App\Models\Astpp\CiSession;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CiSessionResource extends Resource
{
    protected static ?string $model = CiSession::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Ci Sessions'; }
    public static function getModelLabel(): string { return 'Ci Sessions'; }
    public static function getPluralModelLabel(): string { return 'Ci Sessions'; }
    public static function getNavigationSort(): ?int { return 17; }

    public static function form(Schema $schema): Schema
    {
        return CiSessionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CiSessionTable::configure($table);
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
            'index' => Pages\ListCiSessionRecords::route('/'),
            'create' => Pages\CreateCiSession::route('/create'),
            'edit' => Pages\EditCiSession::route('/{record}/edit'),
        ];
    }
}
