<?php

namespace App\Filament\Resources\FusionPBX\GroupPermissions;

use App\Filament\Resources\FusionPBX\GroupPermissions\Pages;
use App\Filament\Resources\FusionPBX\GroupPermissions\Schemas;
use App\Filament\Resources\FusionPBX\GroupPermissions\Tables;
use App\Models\FusionPBX\GroupPermission;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class GroupPermissionResource extends Resource
{
    protected static ?string $slug = 'group-permission';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-shield-check';
    protected static ?int $navigationSort = 12;
protected static ?string $model = GroupPermission::class;
    protected static ?string $modelLabel = 'Group Permission';

    protected static ?string $pluralModelLabel = 'Group Permissions';

    protected static ?string $recordTitleAttribute = 'group_permission_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\GroupPermissionForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\GroupPermissionsTable::configure($table);
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
            'index' => Pages\ListGroupPermissions::route('/'),
            'create' => Pages\CreateGroupPermission::route('/create'),
            'edit' => Pages\EditGroupPermission::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
