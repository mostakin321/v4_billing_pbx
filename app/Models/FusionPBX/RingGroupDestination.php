<?php

namespace App\Models\FusionPBX;

class RingGroupDestination extends BaseFusionPbxModel
{
    protected $table = 'v_ring_group_destinations';
    protected $primaryKey = 'ring_group_destination_uuid';

    // No boolean casts — FusionPBX stores 'true'/'false' strings
    protected $casts = [
        'destination_delay'   => 'integer',
        'destination_timeout' => 'integer',
    ];
}
