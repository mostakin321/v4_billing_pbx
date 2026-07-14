<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRooms\Pages;

use App\Filament\Resources\FusionPBX\ConferenceRooms\ConferenceRoomResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConferenceRoom extends CreateRecord
{
    protected static string $resource = ConferenceRoomResource::class;
}
