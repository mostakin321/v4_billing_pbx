<?php

namespace App\Models\FusionPBX;


class CallBroadcast extends BaseFusionPbxModel
{
    protected $table = 'v_call_broadcasts';

    protected $primaryKey = 'call_broadcast_uuid';

    protected $casts = [
        'broadcast_concurrent_limit' => 'float',
        'broadcast_start_time' => 'float',
        'broadcast_timeout' => 'float',
    ];

}
