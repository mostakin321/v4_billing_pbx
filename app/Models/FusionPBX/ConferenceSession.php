<?php

namespace App\Models\FusionPBX;


class ConferenceSession extends BaseFusionPbxModel
{
    protected $table = 'v_conference_sessions';

    protected $primaryKey = 'conference_session_uuid';

    protected $casts = [
        'end_epoch' => 'float',
        'start_epoch' => 'float',
    ];

}
