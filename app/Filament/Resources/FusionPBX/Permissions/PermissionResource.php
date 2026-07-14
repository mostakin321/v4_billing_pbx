<?php

namespace App\Filament\Resources\FusionPBX\Permissions;

use App\Filament\Resources\FusionPBX\Permissions\Pages;
use App\Filament\Resources\FusionPBX\Permissions\Schemas;
use App\Filament\Resources\FusionPBX\Permissions\Tables;
use App\Models\FusionPBX\Permission;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class PermissionResource extends Resource
{
    protected static ?string $slug = 'permission';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-lock-closed';
    protected static ?int $navigationSort = 11;
protected static ?string $model = Permission::class;
    protected static ?string $modelLabel = 'Permission';

    protected static ?string $pluralModelLabel = 'Permissions';

    protected static ?string $recordTitleAttribute = 'permission_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\PermissionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\PermissionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
