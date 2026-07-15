<?php

namespace App\Http\Controllers\Api\FusionPBX;

class SofiaGlobalSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\SofiaGlobalSetting::class;

    protected string $primaryKey = 'sofia_global_setting_uuid';
}
