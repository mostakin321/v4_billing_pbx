<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessions\Pages;

use App\Filament\Resources\FusionPBX\ConferenceSessions\ConferenceSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceSession extends EditRecord
{
    protected static string $resource = ConferenceSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
