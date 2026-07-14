<?php

namespace App\Models\FusionPBX;


class ContactGroup extends BaseFusionPbxModel
{
    protected $table = 'v_contact_groups';

    protected $primaryKey = 'contact_group_uuid';
}
