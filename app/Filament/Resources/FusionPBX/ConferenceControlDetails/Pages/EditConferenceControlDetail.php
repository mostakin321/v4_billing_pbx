<?php

namespace App\Filament\Resources\FusionPBX\ConferenceControlDetails\Pages;

use App\Filament\Resources\FusionPBX\ConferenceControlDetails\ConferenceControlDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceControlDetail extends EditRecord
{
    protected static string $resource = ConferenceControlDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
