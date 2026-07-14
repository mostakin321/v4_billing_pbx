<?php

namespace App\Models\FusionPBX;


class Notification extends BaseFusionPbxModel
{
    protected $table = 'v_notifications';

    protected $primaryKey = 'notification_uuid';
}
