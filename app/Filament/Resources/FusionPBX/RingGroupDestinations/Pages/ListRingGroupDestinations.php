<?php

namespace App\Filament\Resources\FusionPBX\RingGroupDestinations\Pages;

use App\Filament\Resources\FusionPBX\RingGroupDestinations\RingGroupDestinationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRingGroupDestinations extends ListRecords
{
    protected static string $resource = RingGroupDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
