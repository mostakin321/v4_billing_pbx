<?php

namespace App\Filament\Resources\FusionPBX\CallBroadcasts\Pages;

use App\Filament\Resources\FusionPBX\CallBroadcasts\CallBroadcastResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallBroadcasts extends ListRecords
{
    protected static string $resource = CallBroadcastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
