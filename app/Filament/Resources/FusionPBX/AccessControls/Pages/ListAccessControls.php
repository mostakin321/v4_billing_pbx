<?php

namespace App\Filament\Resources\FusionPBX\AccessControls\Pages;

use App\Filament\Resources\FusionPBX\AccessControls\AccessControlResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessControls extends ListRecords
{
    protected static string $resource = AccessControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
