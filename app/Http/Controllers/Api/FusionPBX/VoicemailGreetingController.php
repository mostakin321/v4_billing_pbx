<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VoicemailGreetingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\VoicemailGreeting::class;

    protected string $primaryKey = 'voicemail_greeting_uuid';
}
