<?php

namespace App\Models\FusionPBX;


class Fax extends BaseFusionPbxModel
{
    protected $table = 'v_fax';

    protected $primaryKey = 'fax_uuid';

    protected $casts = [
        'fax_send_channels' => 'float',
    ];

}
