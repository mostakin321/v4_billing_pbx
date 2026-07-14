<?php

namespace App\Filament\Resources\FusionPBX\ContactRelations\Pages;

use App\Filament\Resources\FusionPBX\ContactRelations\ContactRelationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactRelations extends ListRecords
{
    protected static string $resource = ContactRelationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
