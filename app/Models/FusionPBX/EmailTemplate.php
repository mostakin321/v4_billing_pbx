<?php

namespace App\Models\FusionPBX;


class EmailTemplate extends BaseFusionPbxModel
{
    protected $table = 'v_email_templates';

    protected $primaryKey = 'email_template_uuid';
}
