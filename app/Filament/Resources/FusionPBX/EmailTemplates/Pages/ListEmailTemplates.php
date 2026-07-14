<?php

namespace App\Filament\Resources\FusionPBX\EmailTemplates\Pages;

use App\Filament\Resources\FusionPBX\EmailTemplates\EmailTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmailTemplates extends ListRecords
{
    protected static string $resource = EmailTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
