<?php

namespace App\Http\Controllers\Api\FusionPBX;

class VoicemailOptionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\VoicemailOption::class;

    protected string $primaryKey = 'voicemail_option_uuid';
}
