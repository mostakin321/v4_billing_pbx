<?php

namespace App\Filament\Resources\FusionPBX\DeviceSettings\Pages;

use App\Filament\Resources\FusionPBX\DeviceSettings\DeviceSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceSetting extends EditRecord
{
    protected static string $resource = DeviceSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
