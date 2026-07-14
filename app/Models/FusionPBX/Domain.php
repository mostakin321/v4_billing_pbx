<?php

namespace App\Models\FusionPBX;


class Domain extends BaseFusionPbxModel
{
    protected $table = 'v_domains';

    protected $primaryKey = 'domain_uuid';

    protected $casts = [
        'domain_enabled' => 'boolean',
    ];

}
