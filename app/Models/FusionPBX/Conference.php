<?php

namespace App\Models\FusionPBX;


class Conference extends BaseFusionPbxModel
{
    protected $table = 'v_conferences';

    protected $primaryKey = 'conference_uuid';

    protected $casts = [
        'conference_order' => 'float',
    ];

}
