<?php

namespace App\Models\FusionPBX;


class SofiaGlobalSetting extends BaseFusionPbxModel
{
    protected $table = 'v_sofia_global_settings';

    protected $primaryKey = 'sofia_global_setting_uuid';

    protected $casts = [
        'global_setting_enabled' => 'boolean',
    ];

}
