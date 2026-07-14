<?php

namespace App\Filament\Resources\FusionPBX\Conferences\Pages;

use App\Filament\Resources\FusionPBX\Conferences\ConferenceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferences extends ListRecords
{
    protected static string $resource = ConferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
