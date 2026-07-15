<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactEmailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactEmail::class;

    protected string $primaryKey = 'contact_email_uuid';
}
