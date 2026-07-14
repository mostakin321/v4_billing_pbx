<?php

namespace App\Filament\Resources\FusionPBX\RingGroupUsers\Pages;

use App\Filament\Resources\FusionPBX\RingGroupUsers\RingGroupUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRingGroupUser extends EditRecord
{
    protected static string $resource = RingGroupUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
