<?php

namespace App\Http\Controllers\Api\FusionPBX;

class SipProfileSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\SipProfileSetting::class;

    protected string $primaryKey = 'sip_profile_setting_uuid';
}
