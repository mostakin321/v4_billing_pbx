<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrs\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrs\XmlCdrResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListXmlCdrs extends ListRecords
{
    protected static string $resource = XmlCdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
