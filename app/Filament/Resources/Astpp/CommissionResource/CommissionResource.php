<?php

namespace App\Filament\Resources\Astpp\CommissionResource;

use App\Filament\Resources\Astpp\CommissionResource\Pages;
use App\Filament\Resources\Astpp\CommissionResource\Schemas\CommissionForm;
use App\Filament\Resources\Astpp\CommissionResource\Tables\CommissionTable;
use App\Models\Astpp\Commission;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class CommissionResource extends Resource
{
    protected static ?string $model = Commission::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Products'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Commission'; }
    public static function getModelLabel(): string { return 'Commission'; }
    public static function getPluralModelLabel(): string { return 'Commission'; }
    public static function getNavigationSort(): ?int { return 19; }

    public static function form(Schema $schema): Schema
    {
        return CommissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommissionTable::configure($table);
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
            'index' => Pages\ListCommissionRecords::route('/'),
            'create' => Pages\CreateCommission::route('/create'),
            'edit' => Pages\EditCommission::route('/{record}/edit'),
        ];
    }
}
