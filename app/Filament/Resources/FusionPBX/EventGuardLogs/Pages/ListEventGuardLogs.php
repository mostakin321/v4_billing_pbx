<?php

namespace App\Filament\Resources\FusionPBX\EventGuardLogs\Pages;

use App\Filament\Resources\FusionPBX\EventGuardLogs\EventGuardLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventGuardLogs extends ListRecords
{
    protected static string $resource = EventGuardLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
