<?php

namespace App\Models\FusionPBX;


class User extends BaseFusionPbxModel
{
    protected $table = 'v_users';

    protected $primaryKey = 'user_uuid';
}
