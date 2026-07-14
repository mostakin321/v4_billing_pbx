<?php

namespace App\Filament\Resources\FusionPBX\ContactAttachments\Pages;

use App\Filament\Resources\FusionPBX\ContactAttachments\ContactAttachmentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactAttachment extends CreateRecord
{
    protected static string $resource = ContactAttachmentResource::class;
}
