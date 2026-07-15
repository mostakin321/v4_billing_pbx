<?php

namespace App\Http\Controllers\Api\FusionPBX;

class FaxQueueController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\FaxQueue::class;

    protected string $primaryKey = 'fax_queue_uuid';
}
