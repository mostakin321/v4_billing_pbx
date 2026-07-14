<?php

namespace App\Filament\Resources\FusionPBX\CallCenterQueues\Pages;

use App\Filament\Resources\FusionPBX\CallCenterQueues\CallCenterQueueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallCenterQueue extends EditRecord
{
    protected static string $resource = CallCenterQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
