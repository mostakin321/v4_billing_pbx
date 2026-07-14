<?php

namespace App\Models\FusionPBX;


class ConferenceRoomUser extends BaseFusionPbxModel
{
    protected $table = 'v_conference_room_users';

    protected $primaryKey = 'conference_room_user_uuid';
}
