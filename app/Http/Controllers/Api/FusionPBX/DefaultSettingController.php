<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DefaultSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DefaultSetting::class;

    protected string $primaryKey = 'default_setting_uuid';
}
