<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactAddressController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactAddress::class;

    protected string $primaryKey = 'contact_address_uuid';
}
