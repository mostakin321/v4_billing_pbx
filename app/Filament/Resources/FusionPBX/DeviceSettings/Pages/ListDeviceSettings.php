<?php

namespace App\Filament\Resources\FusionPBX\DeviceSettings\Pages;

use App\Filament\Resources\FusionPBX\DeviceSettings\DeviceSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceSettings extends ListRecords
{
    protected static string $resource = DeviceSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
