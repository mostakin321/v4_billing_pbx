<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Pages;

use App\Filament\Resources\FusionPBX\ConferenceSessionDetails\ConferenceSessionDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceSessionDetails extends ListRecords
{
    protected static string $resource = ConferenceSessionDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
