<?php

namespace App\Models\FusionPBX;


class EmailQueue extends BaseFusionPbxModel
{
    protected $table = 'v_email_queue';

    protected $primaryKey = 'email_queue_uuid';

    protected $casts = [
        'email_date' => 'datetime',
        'email_retry_count' => 'float',
    ];

}
