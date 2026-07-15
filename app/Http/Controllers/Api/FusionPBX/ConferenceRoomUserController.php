<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ConferenceRoomUserController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ConferenceRoomUser::class;

    protected string $primaryKey = 'conference_room_user_uuid';
}
