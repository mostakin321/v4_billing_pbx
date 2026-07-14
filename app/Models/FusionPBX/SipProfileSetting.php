<?php

namespace App\Models\FusionPBX;


class SipProfileSetting extends BaseFusionPbxModel
{
    protected $table = 'v_sip_profile_settings';

    protected $primaryKey = 'sip_profile_setting_uuid';
}
