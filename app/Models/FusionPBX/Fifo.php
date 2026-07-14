<?php

namespace App\Models\FusionPBX;


class Fifo extends BaseFusionPbxModel
{
    protected $table = 'v_fifo';

    protected $primaryKey = 'fifo_uuid';

    protected $casts = [
        'fifo_enabled' => 'boolean',
        'fifo_exit_key' => 'float',
        'fifo_order' => 'float',
    ];

}
