<?php

namespace App\Models\FusionPBX;


class Contact extends BaseFusionPbxModel
{
    protected $table = 'v_contacts';

    protected $primaryKey = 'contact_uuid';
}
