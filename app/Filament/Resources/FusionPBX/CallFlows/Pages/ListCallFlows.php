<?php

namespace App\Filament\Resources\FusionPBX\CallFlows\Pages;

use App\Filament\Resources\FusionPBX\CallFlows\CallFlowResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallFlows extends ListRecords
{
    protected static string $resource = CallFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
