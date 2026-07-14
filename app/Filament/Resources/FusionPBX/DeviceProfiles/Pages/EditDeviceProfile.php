<?php

namespace App\Filament\Resources\FusionPBX\DeviceProfiles\Pages;

use App\Filament\Resources\FusionPBX\DeviceProfiles\DeviceProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceProfile extends EditRecord
{
    protected static string $resource = DeviceProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
