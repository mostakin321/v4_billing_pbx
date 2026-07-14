<?php

namespace App\Models\FusionPBX;


class EventGuardLog extends BaseFusionPbxModel
{
    protected $table = 'v_event_guard_logs';

    protected $primaryKey = 'event_guard_log_uuid';

    protected $casts = [
        'log_date' => 'datetime',
    ];

}
