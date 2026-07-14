<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctions\DeviceVendorFunctionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceVendorFunction extends EditRecord
{
    protected static string $resource = DeviceVendorFunctionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
