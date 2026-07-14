<?php

namespace App\Filament\Resources\FusionPBX\ContactPhones\Pages;

use App\Filament\Resources\FusionPBX\ContactPhones\ContactPhoneResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactPhone extends EditRecord
{
    protected static string $resource = ContactPhoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
