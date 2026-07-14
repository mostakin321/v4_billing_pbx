<?php

namespace App\Filament\Resources\FusionPBX\Contacts\Pages;

use App\Filament\Resources\FusionPBX\Contacts\ContactResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
