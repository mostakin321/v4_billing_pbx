<?php

namespace App\Models\FusionPBX;


class FollowMeDestination extends BaseFusionPbxModel
{
    protected $table = 'v_follow_me_destinations';

    protected $primaryKey = 'follow_me_destination_uuid';

    protected $casts = [
        'follow_me_delay' => 'float',
        'follow_me_order' => 'float',
        'follow_me_timeout' => 'float',
    ];

}
