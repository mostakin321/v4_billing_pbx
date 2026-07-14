<?php

namespace App\Filament\Resources\FusionPBX\RingGroupDestinations\Pages;

use App\Filament\Resources\FusionPBX\RingGroupDestinations\RingGroupDestinationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRingGroupDestination extends EditRecord
{
    protected static string $resource = RingGroupDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
