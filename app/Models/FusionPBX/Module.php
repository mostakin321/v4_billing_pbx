<?php

namespace App\Models\FusionPBX;


class Module extends BaseFusionPbxModel
{
    protected $table = 'v_modules';

    protected $primaryKey = 'module_uuid';

    protected $casts = [
        'module_order' => 'float',
    ];

}
