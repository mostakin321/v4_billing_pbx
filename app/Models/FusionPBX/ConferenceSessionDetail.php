<?php

namespace App\Models\FusionPBX;


class ConferenceSessionDetail extends BaseFusionPbxModel
{
    protected $table = 'v_conference_session_details';

    protected $primaryKey = 'conference_session_detail_uuid';

    protected $casts = [
        'end_epoch' => 'float',
        'start_epoch' => 'float',
    ];

}
