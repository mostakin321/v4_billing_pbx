<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ExtensionSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ExtensionSetting::class;

    protected string $primaryKey = 'extension_setting_uuid';
}
