<?php

namespace App\Http\Controllers\Api\FusionPBX;

class DeviceVendorController extends BaseCrudController
{
    protected string $modelClass = \App\Models\FusionPBX\DeviceVendor::class;

    protected string $primaryKey = 'device_vendor_uuid';
}
