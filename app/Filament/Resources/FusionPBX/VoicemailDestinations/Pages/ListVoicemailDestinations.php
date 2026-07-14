<?php

namespace App\Filament\Resources\FusionPBX\VoicemailDestinations\Pages;

use App\Filament\Resources\FusionPBX\VoicemailDestinations\VoicemailDestinationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVoicemailDestinations extends ListRecords
{
    protected static string $resource = VoicemailDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
