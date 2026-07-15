<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VoicemailController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\Voicemail::class;

    protected string $primaryKey = 'voicemail_uuid';
}
