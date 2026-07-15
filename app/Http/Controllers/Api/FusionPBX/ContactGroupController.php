<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactGroup::class;

    protected string $primaryKey = 'contact_group_uuid';
}
