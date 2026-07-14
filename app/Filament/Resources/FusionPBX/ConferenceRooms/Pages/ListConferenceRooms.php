<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRooms\Pages;

use App\Filament\Resources\FusionPBX\ConferenceRooms\ConferenceRoomResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceRooms extends ListRecords
{
    protected static string $resource = ConferenceRoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
