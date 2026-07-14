<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrJsons\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrJsons\XmlCdrJsonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditXmlCdrJson extends EditRecord
{
    protected static string $resource = XmlCdrJsonResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
