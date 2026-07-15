<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactPhoneController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactPhone::class;

    protected string $primaryKey = 'contact_phone_uuid';
}
