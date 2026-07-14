<?php

namespace App\Models\FusionPBX;


class Clip extends BaseFusionPbxModel
{
    protected $table = 'v_clips';

    protected $primaryKey = 'clip_uuid';
}
