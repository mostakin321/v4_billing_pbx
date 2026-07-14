<?php

namespace App\Models\FusionPBX;


class ConferenceRoom extends BaseFusionPbxModel
{
    protected $table = 'v_conference_rooms';

    protected $primaryKey = 'conference_room_uuid';

    protected $casts = [
        'max_members' => 'float',
    ];

}
