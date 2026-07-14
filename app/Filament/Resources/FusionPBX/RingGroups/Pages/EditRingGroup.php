<?php

namespace App\Filament\Resources\FusionPBX\RingGroups\Pages;

use App\Filament\Resources\FusionPBX\RingGroups\RingGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRingGroup extends EditRecord
{
    protected static string $resource = RingGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
