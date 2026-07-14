<?php

namespace App\Filament\Resources\FusionPBX\ContactAddresses\Pages;

use App\Filament\Resources\FusionPBX\ContactAddresses\ContactAddressResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactAddress extends EditRecord
{
    protected static string $resource = ContactAddressResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
