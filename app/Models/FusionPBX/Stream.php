<?php

namespace App\Models\FusionPBX;


class Stream extends BaseFusionPbxModel
{
    protected $table = 'v_streams';

    protected $primaryKey = 'stream_uuid';
}
