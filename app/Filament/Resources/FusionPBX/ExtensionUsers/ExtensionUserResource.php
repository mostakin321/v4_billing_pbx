<?php

namespace App\Filament\Resources\FusionPBX\ExtensionUsers;

use App\Filament\Resources\FusionPBX\ExtensionUsers\Pages;
use App\Filament\Resources\FusionPBX\ExtensionUsers\Schemas;
use App\Filament\Resources\FusionPBX\ExtensionUsers\Tables;
use App\Models\FusionPBX\ExtensionUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ExtensionUserResource extends Resource
{
    protected static ?string $slug = 'extension-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 2;
protected static ?string $model = ExtensionUser::class;
    protected static ?string $modelLabel = 'Extension User';

    protected static ?string $pluralModelLabel = 'Extension Users';

    protected static ?string $recordTitleAttribute = 'extension_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ExtensionUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ExtensionUsersTable::configure($table);
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
            'index' => Pages\ListExtensionUsers::route('/'),
            'create' => Pages\CreateExtensionUser::route('/create'),
            'edit' => Pages\EditExtensionUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
