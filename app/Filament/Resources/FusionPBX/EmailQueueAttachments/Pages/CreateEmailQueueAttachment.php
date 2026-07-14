<?php

namespace App\Filament\Resources\FusionPBX\EmailQueueAttachments\Pages;

use App\Filament\Resources\FusionPBX\EmailQueueAttachments\EmailQueueAttachmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailQueueAttachment extends CreateRecord
{
    protected static string $resource = EmailQueueAttachmentResource::class;
}
