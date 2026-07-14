<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\ConferenceRoomUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConferenceRoomUser extends CreateRecord
{
    protected static string $resource = ConferenceRoomUserResource::class;
}
