<?php

namespace App\Filament\Resources\FusionPBX\DeviceLogs\Pages;

use App\Filament\Resources\FusionPBX\DeviceLogs\DeviceLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDeviceLog extends CreateRecord
{
    protected static string $resource = DeviceLogResource::class;
}
