<?php

namespace App\Models\FusionPBX;


class UserGroup extends BaseFusionPbxModel
{
    protected $table = 'v_user_groups';

    protected $primaryKey = 'user_group_uuid';
}
