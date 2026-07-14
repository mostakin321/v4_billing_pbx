<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfiles\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfiles\DeviceProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceProfiles extends ListRecords
{
    protected static string $resource = DeviceProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
