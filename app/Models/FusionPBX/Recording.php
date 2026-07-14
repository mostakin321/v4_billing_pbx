<?php

namespace App\Models\FusionPBX;


class Recording extends BaseFusionPbxModel
{
    protected $table = 'v_recordings';

    protected $primaryKey = 'recording_uuid';
}
