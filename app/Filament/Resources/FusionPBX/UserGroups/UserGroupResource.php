<?php

namespace App\Filament\Resources\FusionPBX\UserGroups;

use App\Filament\Resources\FusionPBX\UserGroups\Pages;
use App\Filament\Resources\FusionPBX\UserGroups\Schemas;
use App\Filament\Resources\FusionPBX\UserGroups\Tables;
use App\Models\FusionPBX\UserGroup;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class UserGroupResource extends Resource
{
    protected static ?string $slug = 'user-group';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-circle';
    protected static ?int $navigationSort = 6;
protected static ?string $model = UserGroup::class;
    protected static ?string $modelLabel = 'User Group';

    protected static ?string $pluralModelLabel = 'User Groups';

    protected static ?string $recordTitleAttribute = 'user_group_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\UserGroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\UserGroupsTable::configure($table);
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
            'index' => Pages\ListUserGroups::route('/'),
            'create' => Pages\CreateUserGroup::route('/create'),
            'edit' => Pages\EditUserGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
