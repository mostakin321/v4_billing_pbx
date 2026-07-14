<?php

namespace App\Filament\Resources\FusionPBX\CallCenterTiers\Pages;

use App\Filament\Resources\FusionPBX\CallCenterTiers\CallCenterTierResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallCenterTier extends EditRecord
{
    protected static string $resource = CallCenterTierResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
