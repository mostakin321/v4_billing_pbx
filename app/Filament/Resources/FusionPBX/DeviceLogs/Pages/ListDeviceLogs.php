<?php

namespace App\Filament\Resources\FusionPBX\DeviceLogs\Pages;

use App\Filament\Resources\FusionPBX\DeviceLogs\DeviceLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceLogs extends ListRecords
{
    protected static string $resource = DeviceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
