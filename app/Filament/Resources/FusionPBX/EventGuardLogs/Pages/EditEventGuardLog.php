<?php

namespace App\Filament\Resources\FusionPBX\EventGuardLogs\Pages;

use App\Filament\Resources\FusionPBX\EventGuardLogs\EventGuardLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEventGuardLog extends EditRecord
{
    protected static string $resource = EventGuardLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
