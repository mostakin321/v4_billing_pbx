<?php

namespace App\Filament\Resources\FusionPBX\Conferences\Pages;

use App\Filament\Resources\FusionPBX\Conferences\ConferenceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConference extends EditRecord
{
    protected static string $resource = ConferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
