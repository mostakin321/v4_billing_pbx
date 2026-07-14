<?php

namespace App\Models\FusionPBX;


class ContactSetting extends BaseFusionPbxModel
{
    protected $table = 'v_contact_settings';

    protected $primaryKey = 'contact_setting_uuid';

    protected $casts = [
        'contact_setting_order' => 'float',
    ];

}
