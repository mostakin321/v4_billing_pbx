<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VoicemailMessageController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\VoicemailMessage::class;

    protected string $primaryKey = 'voicemail_message_uuid';
}
