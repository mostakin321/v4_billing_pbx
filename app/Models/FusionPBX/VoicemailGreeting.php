<?php

namespace App\Models\FusionPBX;


class VoicemailGreeting extends BaseFusionPbxModel
{
    protected $table = 'v_voicemail_greetings';

    protected $primaryKey = 'voicemail_greeting_uuid';

    protected $casts = [
        'greeting_id' => 'float',
    ];

}
