<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrs\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrs\XmlCdrResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditXmlCdr extends EditRecord
{
    protected static string $resource = XmlCdrResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
