<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrFlows\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrFlows\XmlCdrFlowResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditXmlCdrFlow extends EditRecord
{
    protected static string $resource = XmlCdrFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
