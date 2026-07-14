<?php

namespace App\Filament\Resources\FusionPBX\ConferenceUsers;

use App\Filament\Resources\FusionPBX\ConferenceUsers\Pages;
use App\Filament\Resources\FusionPBX\ConferenceUsers\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceUsers\Tables;
use App\Models\FusionPBX\ConferenceUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceUserResource extends Resource
{
    protected static ?string $slug = 'conference-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user';
    protected static ?int $navigationSort = 11;
protected static ?string $model = ConferenceUser::class;
    protected static ?string $modelLabel = 'Conference User';

    protected static ?string $pluralModelLabel = 'Conference Users';

    protected static ?string $recordTitleAttribute = 'conference_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceUsersTable::configure($table);
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
            'index' => Pages\ListConferenceUsers::route('/'),
            'create' => Pages\CreateConferenceUser::route('/create'),
            'edit' => Pages\EditConferenceUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
