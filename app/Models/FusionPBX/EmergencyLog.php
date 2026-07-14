<?php

namespace App\Models\FusionPBX;


class EmergencyLog extends BaseFusionPbxModel
{
    protected $table = 'v_emergency_logs';

    protected $primaryKey = 'emergency_log_uuid';

    protected $casts = [
        'extension' => 'float',
    ];

}
