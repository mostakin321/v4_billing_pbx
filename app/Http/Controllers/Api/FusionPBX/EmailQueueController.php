<?php

namespace App\Http\Controllers\Api\FusionPBX;

class EmailQueueController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\EmailQueue::class;

    protected string $primaryKey = 'email_queue_uuid';
}
