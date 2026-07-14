<?php

namespace App\Filament\Resources\FusionPBX\ContactNotes\Pages;

use App\Filament\Resources\FusionPBX\ContactNotes\ContactNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactNote extends CreateRecord
{
    protected static string $resource = ContactNoteResource::class;
}
