<?php

namespace App\Filament\Resources\FusionPBX\RingGroups\Pages;

use App\Filament\Resources\FusionPBX\RingGroups\RingGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRingGroups extends ListRecords
{
    protected static string $resource = RingGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
