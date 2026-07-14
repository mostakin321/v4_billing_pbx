<?php

namespace App\Filament\Resources\FusionPBX\ConferenceCenters\Pages;

use App\Filament\Resources\FusionPBX\ConferenceCenters\ConferenceCenterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceCenters extends ListRecords
{
    protected static string $resource = ConferenceCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
