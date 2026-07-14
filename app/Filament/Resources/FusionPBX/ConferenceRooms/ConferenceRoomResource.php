<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRooms;

use App\Filament\Resources\FusionPBX\ConferenceRooms\Pages;
use App\Filament\Resources\FusionPBX\ConferenceRooms\Schemas;
use App\Filament\Resources\FusionPBX\ConferenceRooms\Tables;
use App\Models\FusionPBX\ConferenceRoom;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;

use Filament\Tables\Table;

class ConferenceRoomResource extends Resource
{
    protected static ?string $slug = 'conference-room';
    protected static \UnitEnum|string|null $navigationGroup = 'Conference';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 3;
protected static ?string $model = ConferenceRoom::class;
    protected static ?string $modelLabel = 'Conference Room';

    protected static ?string $pluralModelLabel = 'Conference Rooms';

    protected static ?string $recordTitleAttribute = 'description';

    public static function form(Schema $form): Schema
    {
        return Schemas\ConferenceRoomForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\ConferenceRoomsTable::configure($table);
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
            'index' => Pages\ListConferenceRooms::route('/'),
            'create' => Pages\CreateConferenceRoom::route('/create'),
            'edit' => Pages\EditConferenceRoom::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Applications';
    }

}
