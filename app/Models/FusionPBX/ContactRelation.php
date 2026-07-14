<?php

namespace App\Models\FusionPBX;


class ContactRelation extends BaseFusionPbxModel
{
    protected $table = 'v_contact_relations';

    protected $primaryKey = 'contact_relation_uuid';
}
