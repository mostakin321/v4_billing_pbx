<?php

namespace App\Filament\Resources\FusionPBX\RingGroupUsers;

use App\Filament\Resources\FusionPBX\RingGroupUsers\Pages;
use App\Filament\Resources\FusionPBX\RingGroupUsers\Schemas;
use App\Filament\Resources\FusionPBX\RingGroupUsers\Tables;
use App\Models\FusionPBX\RingGroupUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class RingGroupUserResource extends Resource
{
    protected static ?string $slug = 'ring-group-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Applications';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 5;
protected static ?string $model = RingGroupUser::class;
    protected static ?string $modelLabel = 'Ring Group User';

    protected static ?string $pluralModelLabel = 'Ring Group Users';

    protected static ?string $recordTitleAttribute = 'ring_group_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\RingGroupUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\RingGroupUsersTable::configure($table);
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
            'index' => Pages\ListRingGroupUsers::route('/'),
            'create' => Pages\CreateRingGroupUser::route('/create'),
            'edit' => Pages\EditRingGroupUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
