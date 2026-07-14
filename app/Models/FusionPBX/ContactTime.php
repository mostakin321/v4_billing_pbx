<?php

namespace App\Models\FusionPBX;


class ContactTime extends BaseFusionPbxModel
{
    protected $table = 'v_contact_times';

    protected $primaryKey = 'contact_time_uuid';

    protected $casts = [
        'time_start' => 'datetime',
        'time_stop' => 'datetime',
    ];

}
