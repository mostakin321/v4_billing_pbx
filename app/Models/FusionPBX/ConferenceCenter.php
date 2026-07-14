<?php

namespace App\Models\FusionPBX;


class ConferenceCenter extends BaseFusionPbxModel
{
    protected $table = 'v_conference_centers';

    protected $primaryKey = 'conference_center_uuid';

    protected $casts = [
        'conference_center_pin_length' => 'float',
    ];

}
