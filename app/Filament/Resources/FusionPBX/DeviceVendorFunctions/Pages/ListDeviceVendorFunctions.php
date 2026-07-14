<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctions\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendorFunctions\DeviceVendorFunctionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceVendorFunctions extends ListRecords
{
    protected static string $resource = DeviceVendorFunctionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
