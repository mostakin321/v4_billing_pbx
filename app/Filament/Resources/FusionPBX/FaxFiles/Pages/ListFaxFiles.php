<?php

namespace App\Filament\Resources\FusionPBX\FaxFiles\Pages;

use App\Filament\Resources\FusionPBX\FaxFiles\FaxFileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaxFiles extends ListRecords
{
    protected static string $resource = FaxFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
