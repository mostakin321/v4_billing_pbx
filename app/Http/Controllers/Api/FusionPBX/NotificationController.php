<?php

namespace App\Http\Controllers\Api\FusionPBX;

class NotificationController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Notification::class;

    protected string $primaryKey = 'notification_uuid';
}
