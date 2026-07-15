<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactUrlController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactUrl::class;

    protected string $primaryKey = 'contact_url_uuid';
}
