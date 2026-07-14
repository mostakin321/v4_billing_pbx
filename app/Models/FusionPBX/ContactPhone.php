<?php

namespace App\Models\FusionPBX;


class ContactPhone extends BaseFusionPbxModel
{
    protected $table = 'v_contact_phones';

    protected $primaryKey = 'contact_phone_uuid';

    protected $casts = [
        'phone_country_code' => 'float',
        'phone_primary' => 'float',
        'phone_type_fax' => 'float',
        'phone_type_text' => 'float',
        'phone_type_video' => 'float',
        'phone_type_voice' => 'float',
    ];

}
