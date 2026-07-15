<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DomainSettingController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DomainSetting::class;

    protected string $primaryKey = 'domain_setting_uuid';
}
