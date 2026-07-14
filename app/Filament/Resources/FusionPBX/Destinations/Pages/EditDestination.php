<?php

namespace App\Filament\Resources\FusionPBX\Destinations\Pages;

use App\Filament\Resources\FusionPBX\Destinations\DestinationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDestination extends EditRecord
{
    protected static string $resource = DestinationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
