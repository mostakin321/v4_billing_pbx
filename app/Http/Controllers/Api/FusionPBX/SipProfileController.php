<?php

namespace App\Http\Controllers\Api\FusionPBX;

class SipProfileController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\SipProfile::class;

    protected string $primaryKey = 'sip_profile_uuid';
}
