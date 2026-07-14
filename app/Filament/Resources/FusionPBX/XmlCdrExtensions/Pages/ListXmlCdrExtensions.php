<?php

namespace App\Filament\Resources\FusionPBX\XmlCdrExtensions\Pages;

use App\Filament\Resources\FusionPBX\XmlCdrExtensions\XmlCdrExtensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListXmlCdrExtensions extends ListRecords
{
    protected static string $resource = XmlCdrExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
