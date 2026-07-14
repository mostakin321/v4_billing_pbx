<?php

namespace App\Filament\Resources\FusionPBX\DeviceLines\Pages;

use App\Filament\Resources\FusionPBX\DeviceLines\DeviceLineResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDeviceLines extends ListRecords
{
    protected static string $resource = DeviceLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
