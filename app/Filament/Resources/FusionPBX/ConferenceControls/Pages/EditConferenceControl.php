<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControls\Pages;

use App\Filament\Resources\FusionPBX\ConferenceControls\ConferenceControlResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceControl extends EditRecord
{
    protected static string $resource = ConferenceControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
