<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrLogs\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrLogs\XmlCdrLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListXmlCdrLogs extends ListRecords
{
    protected static string $resource = XmlCdrLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
