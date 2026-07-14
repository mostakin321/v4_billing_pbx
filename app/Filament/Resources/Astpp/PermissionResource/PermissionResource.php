<?php

namespace App\Filament\Resources\Astpp\PermissionResource;

use App\Filament\Resources\Astpp\PermissionResource\Pages;
use App\Filament\Resources\Astpp\PermissionResource\Schemas\PermissionForm;
use App\Filament\Resources\Astpp\PermissionResource\Tables\PermissionTable;
use App\Models\Astpp\Permission;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Permissions'; }
    public static function getModelLabel(): string { return 'Permissions'; }
    public static function getPluralModelLabel(): string { return 'Permissions'; }
    public static function getNavigationSort(): ?int { return 45; }

    public static function form(Schema $schema): Schema
    {
        return PermissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PermissionTable::configure($table);
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
            'index' => Pages\ListPermissionRecords::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
