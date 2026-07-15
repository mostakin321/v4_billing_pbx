<?php

namespace App\Http\Controllers\Api\FusionPBX;

class UserLogController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\UserLog::class;

    protected string $primaryKey = 'user_log_uuid';
}
