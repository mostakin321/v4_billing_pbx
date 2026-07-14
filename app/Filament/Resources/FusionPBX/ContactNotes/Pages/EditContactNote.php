<?php

namespace App\Filament\Resources\FusionPBX\ContactNotes\Pages;

use App\Filament\Resources\FusionPBX\ContactNotes\ContactNoteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactNote extends EditRecord
{
    protected static string $resource = ContactNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
