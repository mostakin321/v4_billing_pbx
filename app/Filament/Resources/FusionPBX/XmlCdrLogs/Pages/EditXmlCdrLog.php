<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrLogs\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrLogs\XmlCdrLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditXmlCdrLog extends EditRecord
{
    protected static string $resource = XmlCdrLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
