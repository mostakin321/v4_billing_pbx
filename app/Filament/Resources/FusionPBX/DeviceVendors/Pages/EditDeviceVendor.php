<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendors\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendors\DeviceVendorResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceVendor extends EditRecord
{
    protected static string $resource = DeviceVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
