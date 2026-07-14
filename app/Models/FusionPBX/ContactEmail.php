<?php

namespace App\Models\FusionPBX;


class ContactEmail extends BaseFusionPbxModel
{
    protected $table = 'v_contact_emails';

    protected $primaryKey = 'contact_email_uuid';

    protected $casts = [
        'email_primary' => 'float',
    ];

}
