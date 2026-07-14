<?php

namespace App\Filament\Resources\FusionPBX\ConferenceUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceUsers\ConferenceUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceUsers extends ListRecords
{
    protected static string $resource = ConferenceUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
