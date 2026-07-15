<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceVendorFunctionGroupController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceVendorFunctionGroup::class;

    protected string $primaryKey = 'device_vendor_function_group_uuid';
}
