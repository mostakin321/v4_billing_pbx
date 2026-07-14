<?php

namespace App\Models\FusionPBX;


class FaxQueue extends BaseFusionPbxModel
{
    protected $table = 'v_fax_queue';

    protected $primaryKey = 'fax_queue_uuid';

    protected $casts = [
        'fax_date' => 'datetime',
        'fax_notify_date' => 'datetime',
        'fax_notify_sent' => 'boolean',
        'fax_retry_count' => 'float',
        'fax_retry_date' => 'datetime',
    ];

}
