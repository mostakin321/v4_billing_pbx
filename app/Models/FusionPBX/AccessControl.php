<?php

namespace App\Models\FusionPBX;


class AccessControl extends BaseFusionPbxModel
{
    protected $table = 'v_access_controls';

    protected $primaryKey = 'access_control_uuid';
}
