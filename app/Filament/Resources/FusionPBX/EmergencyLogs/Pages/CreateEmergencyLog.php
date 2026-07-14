<?php

namespace App\Filament\Resources\FusionPBX\EmergencyLogs\Pages;

use App\Filament\Resources\FusionPBX\EmergencyLogs\EmergencyLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmergencyLog extends CreateRecord
{
    protected static string $resource = EmergencyLogResource::class;
}
