<?php

namespace App\Http\Controllers\Api\FusionPBX;

class UserSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\UserSetting::class;

    protected string $primaryKey = 'user_setting_uuid';
}
