<?php

namespace App\Filament\Resources\FusionPBX\VoicemailOptions\Pages;

use App\Filament\Resources\FusionPBX\VoicemailOptions\VoicemailOptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVoicemailOption extends EditRecord
{
    protected static string $resource = VoicemailOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
