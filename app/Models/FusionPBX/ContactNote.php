<?php

namespace App\Models\FusionPBX;


class ContactNote extends BaseFusionPbxModel
{
    protected $table = 'v_contact_notes';

    protected $primaryKey = 'contact_note_uuid';
}
