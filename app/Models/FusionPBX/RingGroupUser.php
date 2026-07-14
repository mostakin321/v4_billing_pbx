<?php

namespace App\Models\FusionPBX;


class RingGroupUser extends BaseFusionPbxModel
{
    protected $table = 'v_ring_group_users';

    protected $primaryKey = 'ring_group_user_uuid';
}
