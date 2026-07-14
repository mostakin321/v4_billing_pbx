<?php

namespace App\Models\FusionPBX;


class EmailQueueAttachment extends BaseFusionPbxModel
{
    protected $table = 'v_email_queue_attachments';

    protected $primaryKey = 'email_queue_attachment_uuid';
}
