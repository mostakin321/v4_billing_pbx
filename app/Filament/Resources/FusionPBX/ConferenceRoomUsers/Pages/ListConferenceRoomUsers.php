<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\ConferenceRoomUserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConferenceRoomUsers extends ListRecords
{
    protected static string $resource = ConferenceRoomUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
