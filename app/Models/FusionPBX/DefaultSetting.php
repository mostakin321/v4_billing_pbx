<?php

namespace App\Models\FusionPBX;


class DefaultSetting extends BaseFusionPbxModel
{
    protected $table = 'v_default_settings';

    protected $primaryKey = 'default_setting_uuid';

    protected $casts = [
        'default_setting_enabled' => 'boolean',
        'default_setting_order' => 'float',
    ];

}
