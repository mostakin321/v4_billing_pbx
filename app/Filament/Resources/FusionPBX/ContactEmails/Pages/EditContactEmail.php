<?php

namespace App\Filament\Resources\FusionPBX\ContactEmails\Pages;

use App\Filament\Resources\FusionPBX\ContactEmails\ContactEmailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactEmail extends EditRecord
{
    protected static string $resource = ContactEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
