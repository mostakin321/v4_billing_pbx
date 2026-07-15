<?php

namespace App\Http\Controllers\Api\FusionPBX;

class EmailTemplateController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\EmailTemplate::class;

    protected string $primaryKey = 'email_template_uuid';
}
