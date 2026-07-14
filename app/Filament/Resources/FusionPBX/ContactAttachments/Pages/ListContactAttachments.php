<?php

namespace App\Filament\Resources\FusionPBX\ContactAttachments\Pages;

use App\Filament\Resources\FusionPBX\ContactAttachments\ContactAttachmentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactAttachments extends ListRecords
{
    protected static string $resource = ContactAttachmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
