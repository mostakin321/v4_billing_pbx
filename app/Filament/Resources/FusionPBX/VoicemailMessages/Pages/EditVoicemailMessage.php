<?php

namespace App\Filament\Resources\FusionPBX\VoicemailMessages\Pages;

use App\Filament\Resources\FusionPBX\VoicemailMessages\VoicemailMessageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVoicemailMessage extends EditRecord
{
    protected static string $resource = VoicemailMessageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
