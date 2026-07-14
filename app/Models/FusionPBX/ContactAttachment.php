<?php

namespace App\Models\FusionPBX;


class ContactAttachment extends BaseFusionPbxModel
{
    protected $table = 'v_contact_attachments';

    protected $primaryKey = 'contact_attachment_uuid';

    protected $casts = [
        'attachment_primary' => 'float',
        'attachment_uploaded_date' => 'datetime',
    ];

}
