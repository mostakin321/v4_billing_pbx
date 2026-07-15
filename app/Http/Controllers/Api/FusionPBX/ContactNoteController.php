<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactNoteController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactNote::class;

    protected string $primaryKey = 'contact_note_uuid';
}
