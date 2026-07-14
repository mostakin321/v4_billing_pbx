<?php

namespace App\Models\FusionPBX;


class Bridge extends BaseFusionPbxModel
{
    protected $table = 'v_bridges';

    protected $primaryKey = 'bridge_uuid';
}
