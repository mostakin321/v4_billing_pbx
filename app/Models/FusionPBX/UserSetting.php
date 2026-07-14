<?php

namespace App\Models\FusionPBX;


class UserSetting extends BaseFusionPbxModel
{
    protected $table = 'v_user_settings';

    protected $primaryKey = 'user_setting_uuid';

    protected $casts = [
        'user_setting_enabled' => 'boolean',
        'user_setting_order' => 'float',
    ];

}
