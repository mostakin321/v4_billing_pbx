<?php

namespace App\Models\FusionPBX;


class Destination extends BaseFusionPbxModel
{
    protected $table = 'v_destinations';

    protected $primaryKey = 'destination_uuid';

    protected $casts = [
        'destination_actions' => 'array',
        'destination_conditions' => 'array',
        'destination_order' => 'float',
        'destination_type_emergency' => 'float',
        'destination_type_fax' => 'float',
        'destination_type_text' => 'float',
        'destination_type_voice' => 'float',
    ];

}
