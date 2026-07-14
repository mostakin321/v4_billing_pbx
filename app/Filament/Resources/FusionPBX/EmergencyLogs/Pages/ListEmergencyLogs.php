<?php

namespace App\Filament\Resources\FusionPBX\EmergencyLogs\Pages;

use App\Filament\Resources\FusionPBX\EmergencyLogs\EmergencyLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmergencyLogs extends ListRecords
{
    protected static string $resource = EmergencyLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
