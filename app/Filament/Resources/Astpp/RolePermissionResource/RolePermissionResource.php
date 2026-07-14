<?php

namespace App\Filament\Resources\Astpp\RolePermissionResource;

use App\Filament\Resources\Astpp\RolePermissionResource\Pages;
use App\Filament\Resources\Astpp\RolePermissionResource\Schemas\RolePermissionForm;
use App\Filament\Resources\Astpp\RolePermissionResource\Tables\RolePermissionTable;
use App\Models\Astpp\RolePermission;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class RolePermissionResource extends Resource
{
    protected static ?string $model = RolePermission::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Roles And Permission'; }
    public static function getModelLabel(): string { return 'Roles And Permission'; }
    public static function getPluralModelLabel(): string { return 'Roles And Permission'; }
    public static function getNavigationSort(): ?int { return 55; }

    public static function form(Schema $schema): Schema
    {
        return RolePermissionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolePermissionTable::configure($table);
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
            'index' => Pages\ListRolePermissionRecords::route('/'),
            'create' => Pages\CreateRolePermission::route('/create'),
            'edit' => Pages\EditRolePermission::route('/{record}/edit'),
        ];
    }
}
