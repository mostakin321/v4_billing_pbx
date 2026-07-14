<?php

namespace App\Models\FusionPBX;


class VoicemailMessage extends BaseFusionPbxModel
{
    protected $table = 'v_voicemail_messages';

    protected $primaryKey = 'voicemail_message_uuid';

    protected $casts = [
        'created_epoch' => 'float',
        'message_length' => 'float',
        'read_epoch' => 'float',
    ];

}
