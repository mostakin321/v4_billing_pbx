<?php

namespace App\Models\FusionPBX;


class DeviceProfile extends BaseFusionPbxModel
{
    protected $table = 'v_device_profiles';

    protected $primaryKey = 'device_profile_uuid';
}
