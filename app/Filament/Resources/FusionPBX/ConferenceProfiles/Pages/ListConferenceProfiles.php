<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfiles\Pages;

use App\Filament\Resources\FusionPBX\ConferenceProfiles\ConferenceProfileResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceProfiles extends ListRecords
{
    protected static string $resource = ConferenceProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
