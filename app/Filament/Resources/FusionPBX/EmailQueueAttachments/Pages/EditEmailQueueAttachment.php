<?php

namespace App\Filament\Resources\FusionPBX\EmailQueueAttachments\Pages;

use App\Filament\Resources\FusionPBX\EmailQueueAttachments\EmailQueueAttachmentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEmailQueueAttachment extends EditRecord
{
    protected static string $resource = EmailQueueAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
