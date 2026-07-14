<?php

namespace App\Filament\Resources\FusionPBX\ConferenceRoomUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceRoomUsers\ConferenceRoomUserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceRoomUser extends EditRecord
{
    protected static string $resource = ConferenceRoomUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
