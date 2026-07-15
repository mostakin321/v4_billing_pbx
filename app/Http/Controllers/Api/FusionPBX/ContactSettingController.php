<?php

namespace App\Http\Controllers\Api\FusionPBX;

class ContactSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\ContactSetting::class;

    protected string $primaryKey = 'contact_setting_uuid';
}
