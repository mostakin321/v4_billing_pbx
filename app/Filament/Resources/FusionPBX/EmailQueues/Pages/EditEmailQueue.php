<?php

namespace App\Filament\Resources\FusionPBX\EmailQueues\Pages;

use App\Filament\Resources\FusionPBX\EmailQueues\EmailQueueResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmailQueue extends EditRecord
{
    protected static string $resource = EmailQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
