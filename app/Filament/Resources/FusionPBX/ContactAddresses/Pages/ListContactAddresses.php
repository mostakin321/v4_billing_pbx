<?php

namespace App\Filament\Resources\FusionPBX\ContactAddresses\Pages;

use App\Filament\Resources\FusionPBX\ContactAddresses\ContactAddressResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactAddresses extends ListRecords
{
    protected static string $resource = ContactAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
