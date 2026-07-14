<?php

namespace App\Models\FusionPBX;


class ContactUrl extends BaseFusionPbxModel
{
    protected $table = 'v_contact_urls';

    protected $primaryKey = 'contact_url_uuid';

    protected $casts = [
        'url_primary' => 'float',
    ];

}
