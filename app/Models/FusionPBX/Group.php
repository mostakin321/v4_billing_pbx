<?php

namespace App\Models\FusionPBX;


class Group extends BaseFusionPbxModel
{
    protected $table = 'v_groups';

    protected $primaryKey = 'group_uuid';

    protected $casts = [
        'group_level' => 'float',
    ];

}
