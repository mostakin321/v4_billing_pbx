<?php

namespace App\Filament\Resources\FusionPBX\EventGuardLogs\Pages;

use App\Filament\Resources\FusionPBX\EventGuardLogs\EventGuardLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEventGuardLog extends CreateRecord
{
    protected static string $resource = EventGuardLogResource::class;
}
