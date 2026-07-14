<?php

namespace App\Filament\Resources\FusionPBX\ConferenceSessionDetails\Pages;

use App\Filament\Resources\FusionPBX\ConferenceSessionDetails\ConferenceSessionDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceSessionDetail extends EditRecord
{
    protected static string $resource = ConferenceSessionDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
