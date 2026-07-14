<?php

namespace App\Filament\Resources\FusionPBX\DeviceLogs\Pages;

use App\Filament\Resources\FusionPBX\DeviceLogs\DeviceLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceLog extends EditRecord
{
    protected static string $resource = DeviceLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
