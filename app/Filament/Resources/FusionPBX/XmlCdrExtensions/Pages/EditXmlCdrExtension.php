<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrExtensions\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrExtensions\XmlCdrExtensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditXmlCdrExtension extends EditRecord
{
    protected static string $resource = XmlCdrExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
