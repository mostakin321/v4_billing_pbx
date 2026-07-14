<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileSettings\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfileSettings\DeviceProfileSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceProfileSettings extends ListRecords
{
    protected static string $resource = DeviceProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
