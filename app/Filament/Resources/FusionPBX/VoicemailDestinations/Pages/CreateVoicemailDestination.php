<?php

namespace App\Filament\Resources\FusionPBX\VoicemailDestinations\Pages;

use App\Filament\Resources\FusionPBX\VoicemailDestinations\VoicemailDestinationResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoicemailDestination extends CreateRecord
{
    protected static string $resource = VoicemailDestinationResource::class;
}
