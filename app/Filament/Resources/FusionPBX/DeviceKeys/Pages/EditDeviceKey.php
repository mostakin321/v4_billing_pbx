<?php

namespace App\Filament\Resources\FusionPBX\DeviceKeys\Pages;

use App\Filament\Resources\FusionPBX\DeviceKeys\DeviceKeyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceKey extends EditRecord
{
    protected static string $resource = DeviceKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
