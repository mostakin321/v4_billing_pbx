<?php

namespace App\Filament\Resources\FusionPBX\Users;

use App\Filament\Resources\FusionPBX\Users\Pages;
use App\Filament\Resources\FusionPBX\Users\Schemas;
use App\Filament\Resources\FusionPBX\Users\Tables;
use App\Models\FusionPBX\User;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $slug = 'user';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 4;
protected static ?string $model = User::class;
    protected static ?string $modelLabel = 'User';

    protected static ?string $pluralModelLabel = 'Users';

    protected static ?string $recordTitleAttribute = 'username';

    public static function form(Schema $form): Schema
    {
        return Schemas\UserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\UsersTable::configure($table);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
