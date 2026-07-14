<?php

namespace App\Filament\Resources\FusionPBX\ContactPhones\Pages;

use App\Filament\Resources\FusionPBX\ContactPhones\ContactPhoneResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactPhones extends ListRecords
{
    protected static string $resource = ContactPhoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
