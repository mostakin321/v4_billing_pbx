<?php

namespace App\Models\FusionPBX;


class SipProfile extends BaseFusionPbxModel
{
    protected $table = 'v_sip_profiles';

    protected $primaryKey = 'sip_profile_uuid';
}
