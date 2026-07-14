<?php

namespace App\Models\FusionPBX;


class ExtensionUser extends BaseFusionPbxModel
{
    protected $table = 'v_extension_users';

    protected $primaryKey = 'extension_user_uuid';
}
