<?php

namespace App\Filament\Resources\FusionPBX\Groups;

use App\Filament\Resources\FusionPBX\Groups\Pages;
use App\Filament\Resources\FusionPBX\Groups\Schemas;
use App\Filament\Resources\FusionPBX\Groups\Tables;
use App\Models\FusionPBX\Group;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class GroupResource extends Resource
{
    protected static ?string $slug = 'group';
    protected static \UnitEnum|string|null $navigationGroup = 'Accounts';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 5;
protected static ?string $model = Group::class;
    protected static ?string $modelLabel = 'Group';

    protected static ?string $pluralModelLabel = 'Groups';

    protected static ?string $recordTitleAttribute = 'group_name';

    public static function form(Schema $form): Schema
    {
        return Schemas\GroupForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\GroupsTable::configure($table);
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Accounts';
    }

}
