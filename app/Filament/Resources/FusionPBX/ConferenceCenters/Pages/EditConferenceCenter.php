<?php

namespace App\Filament\Resources\FusionPBX\ConferenceCenters\Pages;

use App\Filament\Resources\FusionPBX\ConferenceCenters\ConferenceCenterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceCenter extends EditRecord
{
    protected static string $resource = ConferenceCenterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
