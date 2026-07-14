<?php

namespace App\Filament\Resources\FusionPBX\Voicemails\Pages;

use App\Filament\Resources\FusionPBX\Voicemails\VoicemailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVoicemail extends EditRecord
{
    protected static string $resource = VoicemailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
