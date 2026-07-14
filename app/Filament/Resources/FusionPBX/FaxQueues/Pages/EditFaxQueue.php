<?php

namespace App\Filament\Resources\FusionPBX\FaxQueues\Pages;

use App\Filament\Resources\FusionPBX\FaxQueues\FaxQueueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFaxQueue extends EditRecord
{
    protected static string $resource = FaxQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
