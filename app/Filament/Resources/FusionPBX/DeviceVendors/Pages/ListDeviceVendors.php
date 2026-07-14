<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendors\Pages;

use App\Filament\Resources\FusionPBX\DeviceVendors\DeviceVendorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceVendors extends ListRecords
{
    protected static string $resource = DeviceVendorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
