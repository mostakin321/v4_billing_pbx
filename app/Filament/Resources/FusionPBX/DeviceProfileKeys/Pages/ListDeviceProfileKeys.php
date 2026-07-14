<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileKeys\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfileKeys\DeviceProfileKeyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceProfileKeys extends ListRecords
{
    protected static string $resource = DeviceProfileKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
