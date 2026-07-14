<?php

namespace App\Models\FusionPBX;


class Country extends BaseFusionPbxModel
{
    protected $table = 'v_countries';

    protected $primaryKey = 'country_uuid';

    protected $casts = [
        'num' => 'float',
    ];

}
