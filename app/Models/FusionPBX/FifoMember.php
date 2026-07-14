<?php

namespace App\Models\FusionPBX;


class FifoMember extends BaseFusionPbxModel
{
    protected $table = 'v_fifo_members';

    protected $primaryKey = 'fifo_member_uuid';

    protected $casts = [
        'member_call_timeout' => 'float',
        'member_enabled' => 'boolean',
        'member_simultaneous' => 'float',
        'member_wrap_up_time' => 'float',
    ];

}
