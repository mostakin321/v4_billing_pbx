<?php

namespace App\Models\FusionPBX;


class FaxUser extends BaseFusionPbxModel
{
    protected $table = 'v_fax_users';

    protected $primaryKey = 'fax_user_uuid';
}
