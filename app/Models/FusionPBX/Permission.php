<?php

namespace App\Models\FusionPBX;


class Permission extends BaseFusionPbxModel
{
    protected $table = 'v_permissions';

    protected $primaryKey = 'permission_uuid';
}
