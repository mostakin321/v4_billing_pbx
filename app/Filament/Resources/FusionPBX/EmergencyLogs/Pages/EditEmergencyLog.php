<?php

namespace App\Filament\Resources\FusionPBX\EmergencyLogs\Pages;

use App\Filament\Resources\FusionPBX\EmergencyLogs\EmergencyLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmergencyLog extends EditRecord
{
    protected static string $resource = EmergencyLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
