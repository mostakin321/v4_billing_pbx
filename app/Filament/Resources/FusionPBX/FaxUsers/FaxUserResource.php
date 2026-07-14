<?php

namespace App\Filament\Resources\FusionPBX\FaxUsers;

use App\Filament\Resources\FusionPBX\FaxUsers\Pages;
use App\Filament\Resources\FusionPBX\FaxUsers\Schemas;
use App\Filament\Resources\FusionPBX\FaxUsers\Tables;
use App\Models\FusionPBX\FaxUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class FaxUserResource extends Resource
{
    protected static ?string $slug = 'fax-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Fax';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 3;
protected static ?string $model = FaxUser::class;
    protected static ?string $modelLabel = 'Fax User';

    protected static ?string $pluralModelLabel = 'Fax Users';

    protected static ?string $recordTitleAttribute = 'fax_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\FaxUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\FaxUsersTable::configure($table);
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
            'index' => Pages\ListFaxUsers::route('/'),
            'create' => Pages\CreateFaxUser::route('/create'),
            'edit' => Pages\EditFaxUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
