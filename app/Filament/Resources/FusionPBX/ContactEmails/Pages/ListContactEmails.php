<?php

namespace App\Filament\Resources\FusionPBX\ContactEmails\Pages;

use App\Filament\Resources\FusionPBX\ContactEmails\ContactEmailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactEmails extends ListRecords
{
    protected static string $resource = ContactEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
