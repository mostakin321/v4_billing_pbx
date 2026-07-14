<?php

namespace App\Models\FusionPBX;


class DomainSetting extends BaseFusionPbxModel
{
    protected $table = 'v_domain_settings';

    protected $primaryKey = 'domain_setting_uuid';

    protected $casts = [
        'domain_setting_enabled' => 'boolean',
        'domain_setting_order' => 'float',
    ];

}
