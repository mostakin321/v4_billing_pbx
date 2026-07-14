<?php

namespace App\Filament\Resources\FusionPBX\ContactNotes\Pages;

use App\Filament\Resources\FusionPBX\ContactNotes\ContactNoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactNotes extends ListRecords
{
    protected static string $resource = ContactNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
