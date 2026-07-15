<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceVendorFunctionController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceVendorFunction::class;

    protected string $primaryKey = 'device_vendor_function_uuid';
}
