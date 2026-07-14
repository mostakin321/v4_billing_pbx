<?php

namespace App\Filament\Resources\FusionPBX\ConferenceProfileParams\Pages;

use App\Filament\Resources\FusionPBX\ConferenceProfileParams\ConferenceProfileParamResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditConferenceProfileParam extends EditRecord
{
    protected static string $resource = ConferenceProfileParamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
