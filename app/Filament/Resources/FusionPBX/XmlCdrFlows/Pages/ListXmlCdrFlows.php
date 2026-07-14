<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrFlows\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrFlows\XmlCdrFlowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListXmlCdrFlows extends ListRecords
{
    protected static string $resource = XmlCdrFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
