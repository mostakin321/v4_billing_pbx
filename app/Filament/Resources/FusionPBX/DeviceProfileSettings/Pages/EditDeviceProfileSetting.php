<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfileSettings\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfileSettings\DeviceProfileSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceProfileSetting extends EditRecord
{
    protected static string $resource = DeviceProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
