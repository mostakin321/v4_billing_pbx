<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControls\Pages;

use App\Filament\Resources\FusionPBX\ConferenceControls\ConferenceControlResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceControls extends ListRecords
{
    protected static string $resource = ConferenceControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
