<?php

namespace App\Models\FusionPBX;


class ConferenceProfile extends BaseFusionPbxModel
{
    protected $table = 'v_conference_profiles';

    protected $primaryKey = 'conference_profile_uuid';
}
