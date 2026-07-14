<?php

namespace App\Models\FusionPBX;


class Dialplan extends BaseFusionPbxModel
{
    protected $table = 'v_dialplans';

    protected $primaryKey = 'dialplan_uuid';

    protected $casts = [
        'dialplan_order' => 'float',
    ];

}
