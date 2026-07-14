<?php

namespace App\Models\FusionPBX;


class GroupPermission extends BaseFusionPbxModel
{
    protected $table = 'v_group_permissions';

    protected $primaryKey = 'group_permission_uuid';
}
