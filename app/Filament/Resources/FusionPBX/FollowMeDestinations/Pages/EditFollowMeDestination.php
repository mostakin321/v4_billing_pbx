<?php

namespace App\Filament\Resources\FusionPBX\FollowMeDestinations\Pages;

use App\Filament\Resources\FusionPBX\FollowMeDestinations\FollowMeDestinationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFollowMeDestination extends EditRecord
{
    protected static string $resource = FollowMeDestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
