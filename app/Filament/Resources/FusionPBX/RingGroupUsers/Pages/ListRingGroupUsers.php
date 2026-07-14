<?php

namespace App\Filament\Resources\FusionPBX\RingGroupUsers\Pages;

use App\Filament\Resources\FusionPBX\RingGroupUsers\RingGroupUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRingGroupUsers extends ListRecords
{
    protected static string $resource = RingGroupUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
