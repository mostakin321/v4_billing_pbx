<?php

namespace App\Filament\Resources\Astpp\ResellerCdrResource;

use App\Filament\Resources\Astpp\ResellerCdrResource\Pages;
use App\Filament\Resources\Astpp\ResellerCdrResource\Schemas\ResellerCdrForm;
use App\Filament\Resources\Astpp\ResellerCdrResource\Tables\ResellerCdrTable;
use App\Models\Astpp\ResellerCdr;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class ResellerCdrResource extends Resource
{
    protected static ?string $model = ResellerCdr::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP CDR'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-circle-stack'; }
    public static function getNavigationLabel(): string { return 'Reseller CDRs'; }
    public static function getModelLabel(): string { return 'Reseller CDRs'; }
    public static function getPluralModelLabel(): string { return 'Reseller CDRs'; }
    public static function getNavigationSort(): ?int { return 53; }

    public static function form(Schema $schema): Schema
    {
        return ResellerCdrForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResellerCdrTable::configure($table);
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
            'index' => Pages\ListResellerCdrRecords::route('/'),
            'create' => Pages\CreateResellerCdr::route('/create'),
            'edit' => Pages\EditResellerCdr::route('/{record}/edit'),
        ];
    }
}
