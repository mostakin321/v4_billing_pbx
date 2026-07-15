<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceRoomController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceRoom::class;

    protected string $primaryKey = 'conference_room_uuid';
}
