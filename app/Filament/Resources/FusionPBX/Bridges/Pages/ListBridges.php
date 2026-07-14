<?php

namespace App\Filament\Resources\FusionPBX\Bridges\Pages;

use App\Filament\Resources\FusionPBX\Bridges\BridgeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBridges extends ListRecords
{
    protected static string $resource = BridgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
