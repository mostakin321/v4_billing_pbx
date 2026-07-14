<?php

namespace App\Filament\Resources\FusionPBX\FaxLogs\Pages;

use App\Filament\Resources\FusionPBX\FaxLogs\FaxLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaxLog extends EditRecord
{
    protected static string $resource = FaxLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
