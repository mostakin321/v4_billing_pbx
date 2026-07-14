<?php

namespace App\Filament\Resources\FusionPBX\ContactRelations\Pages;

use App\Filament\Resources\FusionPBX\ContactRelations\ContactRelationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactRelation extends EditRecord
{
    protected static string $resource = ContactRelationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
