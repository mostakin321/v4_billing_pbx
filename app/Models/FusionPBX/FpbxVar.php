<?php

namespace App\Models\FusionPBX;


class FpbxVar extends BaseFusionPbxModel
{
    protected $table = 'v_vars';

    protected $primaryKey = 'var_uuid';

    protected $casts = [
        'var_order' => 'float',
    ];

}
