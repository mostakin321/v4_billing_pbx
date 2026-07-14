<?php

namespace App\Filament\Resources\Astpp\PackagePatternResource;

use App\Filament\Resources\Astpp\PackagePatternResource\Pages;
use App\Filament\Resources\Astpp\PackagePatternResource\Schemas\PackagePatternForm;
use App\Filament\Resources\Astpp\PackagePatternResource\Tables\PackagePatternTable;
use App\Models\Astpp\PackagePattern;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class PackagePatternResource extends Resource
{
    protected static ?string $model = PackagePattern::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP Rating'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Package Patterns'; }
    public static function getModelLabel(): string { return 'Package Patterns'; }
    public static function getPluralModelLabel(): string { return 'Package Patterns'; }
    public static function getNavigationSort(): ?int { return 43; }

    public static function form(Schema $schema): Schema
    {
        return PackagePatternForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PackagePatternTable::configure($table);
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
            'index' => Pages\ListPackagePatternRecords::route('/'),
            'create' => Pages\CreatePackagePattern::route('/create'),
            'edit' => Pages\EditPackagePattern::route('/{record}/edit'),
        ];
    }
}
