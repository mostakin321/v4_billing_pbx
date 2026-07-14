<?php

namespace App\Filament\Resources\FusionPBX\VoicemailDestinations\Pages;

use App\Filament\Resources\FusionPBX\VoicemailDestinations\VoicemailDestinationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVoicemailDestination extends EditRecord
{
    protected static string $resource = VoicemailDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
