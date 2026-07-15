<?php

namespace App\Http\Controllers\Api\FusionPBX;

class EmailQueueAttachmentController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\EmailQueueAttachment::class;

    protected string $primaryKey = 'email_queue_attachment_uuid';
}
