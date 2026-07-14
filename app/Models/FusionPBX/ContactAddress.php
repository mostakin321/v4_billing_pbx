<?php

namespace App\Models\FusionPBX;


class ContactAddress extends BaseFusionPbxModel
{
    protected $table = 'v_contact_addresses';

    protected $primaryKey = 'contact_address_uuid';

    protected $casts = [
        'address_primary' => 'float',
    ];

}
