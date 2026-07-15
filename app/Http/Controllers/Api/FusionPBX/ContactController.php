<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Contact::class;

    protected string $primaryKey = 'contact_uuid';
}
