<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControlDetails\Pages;

use App\Filament\Resources\FusionPBX\ConferenceControlDetails\ConferenceControlDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceControlDetails extends ListRecords
{
    protected static string $resource = ConferenceControlDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
