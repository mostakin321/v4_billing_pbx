<?php

namespace App\Models\FusionPBX;


class ContactUser extends BaseFusionPbxModel
{
    protected $table = 'v_contact_users';

    protected $primaryKey = 'contact_user_uuid';
}
