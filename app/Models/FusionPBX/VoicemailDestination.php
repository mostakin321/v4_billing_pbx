<?php

namespace App\Models\FusionPBX;


class VoicemailDestination extends BaseFusionPbxModel
{
    protected $table = 'v_voicemail_destinations';

    protected $primaryKey = 'voicemail_destination_uuid';
}
