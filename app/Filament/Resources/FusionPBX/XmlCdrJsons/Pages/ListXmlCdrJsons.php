<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrJsons\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrJsons\XmlCdrJsonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListXmlCdrJsons extends ListRecords
{
    protected static string $resource = XmlCdrJsonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
