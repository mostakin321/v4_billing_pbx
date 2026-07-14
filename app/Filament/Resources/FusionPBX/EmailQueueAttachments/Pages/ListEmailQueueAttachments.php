<?php

namespace App\Filament\Resources\FusionPBX\EmailQueueAttachments\Pages;

use App\Filament\Resources\FusionPBX\EmailQueueAttachments\EmailQueueAttachmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmailQueueAttachments extends ListRecords
{
    protected static string $resource = EmailQueueAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
