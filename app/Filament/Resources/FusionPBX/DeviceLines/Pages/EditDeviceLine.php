<?php

namespace App\Filament\Resources\FusionPBX\DeviceLines\Pages;

use App\Filament\Resources\FusionPBX\DeviceLines\DeviceLineResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDeviceLine extends EditRecord
{
    protected static string $resource = DeviceLineResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
