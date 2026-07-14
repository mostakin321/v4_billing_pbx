<?php

namespace App\Filament\Resources\FusionPBX\DeviceKeys\Pages;

use App\Filament\Resources\FusionPBX\DeviceKeys\DeviceKeyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceKeys extends ListRecords
{
    protected static string $resource = DeviceKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
