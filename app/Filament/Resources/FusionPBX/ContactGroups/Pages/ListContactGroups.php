<?php

namespace App\Filament\Resources\FusionPBX\ContactGroups\Pages;

use App\Filament\Resources\FusionPBX\ContactGroups\ContactGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactGroups extends ListRecords
{
    protected static string $resource = ContactGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
