<?php

namespace App\Filament\Resources\FusionPBX\FollowMeDestinations\Pages;

use App\Filament\Resources\FusionPBX\FollowMeDestinations\FollowMeDestinationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFollowMeDestinations extends ListRecords
{
    protected static string $resource = FollowMeDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
