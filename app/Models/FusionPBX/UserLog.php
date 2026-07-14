<?php

namespace App\Models\FusionPBX;


class UserLog extends BaseFusionPbxModel
{
    protected $table = 'v_user_logs';

    protected $primaryKey = 'user_log_uuid';
}
