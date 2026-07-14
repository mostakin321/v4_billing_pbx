<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\DeviceVendorFunctionGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceVendorFunctionGroups extends ListRecords
{
    protected static string $resource = DeviceVendorFunctionGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
