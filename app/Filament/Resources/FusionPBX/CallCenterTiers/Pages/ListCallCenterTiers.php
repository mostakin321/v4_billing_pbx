<?php

namespace App\Filament\Resources\FusionPBX\CallCenterTiers\Pages;

use App\Filament\Resources\FusionPBX\CallCenterTiers\CallCenterTierResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallCenterTiers extends ListRecords
{
    protected static string $resource = CallCenterTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
