<?php

namespace App\Models\FusionPBX;


class Voicemail extends BaseFusionPbxModel
{
    protected $table = 'v_voicemails';

    protected $primaryKey = 'voicemail_uuid';

    protected $casts = [
        'greeting_id' => 'float',
        'voicemail_alternate_greet_id' => 'float',
    ];

}
