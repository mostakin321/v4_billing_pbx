<?php

namespace App\Filament\Resources\FusionPBX\ContactUrls\Pages;

use App\Filament\Resources\FusionPBX\ContactUrls\ContactUrlResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactUrl extends EditRecord
{
    protected static string $resource = ContactUrlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
