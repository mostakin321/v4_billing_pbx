<?php

namespace App\Models\FusionPBX;


class ConferenceUser extends BaseFusionPbxModel
{
    protected $table = 'v_conference_users';

    protected $primaryKey = 'conference_user_uuid';
}
