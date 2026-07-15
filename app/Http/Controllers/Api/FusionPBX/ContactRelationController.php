<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactRelationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactRelation::class;

    protected string $primaryKey = 'contact_relation_uuid';
}
