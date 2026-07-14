<?php

namespace App\Models\FusionPBX;


class VoicemailOption extends BaseFusionPbxModel
{
    protected $table = 'v_voicemail_options';

    protected $primaryKey = 'voicemail_option_uuid';

    protected $casts = [
        'voicemail_option_order' => 'float',
    ];

}
