<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfiles\Pages;

use App\Filament\Resources\FusionPBX\ConferenceProfiles\ConferenceProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceProfile extends EditRecord
{
    protected static string $resource = ConferenceProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
