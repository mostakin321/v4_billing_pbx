<?php

namespace App\Models\FusionPBX;


class SipProfileDomain extends BaseFusionPbxModel
{
    protected $table = 'v_sip_profile_domains';

    protected $primaryKey = 'sip_profile_domain_uuid';
}
