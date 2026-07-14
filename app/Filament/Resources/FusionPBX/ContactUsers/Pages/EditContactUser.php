<?php

namespace App\Filament\Resources\FusionPBX\ContactUsers\Pages;

use App\Filament\Resources\FusionPBX\ContactUsers\ContactUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactUser extends EditRecord
{
    protected static string $resource = ContactUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
