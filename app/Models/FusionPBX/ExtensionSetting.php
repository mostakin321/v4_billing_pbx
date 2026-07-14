<?php

namespace App\Models\FusionPBX;


class ExtensionSetting extends BaseFusionPbxModel
{
    protected $table = 'v_extension_settings';

    protected $primaryKey = 'extension_setting_uuid';

    protected $casts = [
        'extension_setting_enabled' => 'boolean',
    ];

}
