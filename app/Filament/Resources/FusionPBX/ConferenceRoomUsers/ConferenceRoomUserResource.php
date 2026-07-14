<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRoomUsers;

use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Pages;
use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Tables;
use App\Models\FusionPBX\ConferenceRoomUser;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceRoomUserResource extends Resource
{
    protected static ?string $slug = 'conference-room-user';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-user-group';
    protected static ?int $navigationSort = 4;
protected static ?string $model = ConferenceRoomUser::class;
    protected static ?string $modelLabel = 'Conference Room User';

    protected static ?string $pluralModelLabel = 'Conference Room Users';

    protected static ?string $recordTitleAttribute = 'conference_room_user_uuid';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceRoomUserForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceRoomUsersTable::configure($table);
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
            'index' => Pages\ListConferenceRoomUsers::route('/'),
            'create' => Pages\CreateConferenceRoomUser::route('/create'),
            'edit' => Pages\EditConferenceRoomUser::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
