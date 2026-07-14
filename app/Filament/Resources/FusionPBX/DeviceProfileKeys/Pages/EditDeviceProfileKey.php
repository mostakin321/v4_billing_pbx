<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileKeys\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfileKeys\DeviceProfileKeyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceProfileKey extends EditRecord
{
    protected static string $resource = DeviceProfileKeyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
