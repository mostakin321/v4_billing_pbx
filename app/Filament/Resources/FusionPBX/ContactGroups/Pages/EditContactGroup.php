<?php

namespace App\Filament\Resources\FusionPBX\ContactGroups\Pages;

use App\Filament\Resources\FusionPBX\ContactGroups\ContactGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactGroup extends EditRecord
{
    protected static string $resource = ContactGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
