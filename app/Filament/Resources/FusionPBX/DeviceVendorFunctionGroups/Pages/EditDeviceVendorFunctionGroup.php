<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\DeviceVendorFunctionGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceVendorFunctionGroup extends EditRecord
{
    protected static string $resource = DeviceVendorFunctionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
