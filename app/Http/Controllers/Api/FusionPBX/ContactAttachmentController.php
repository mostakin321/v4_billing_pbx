<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactAttachmentController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactAttachment::class;

    protected string $primaryKey = 'contact_attachment_uuid';
}
