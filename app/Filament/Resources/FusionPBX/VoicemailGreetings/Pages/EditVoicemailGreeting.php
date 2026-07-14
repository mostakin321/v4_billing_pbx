<?php

namespace App\Filament\Resources\FusionPBX\VoicemailGreetings\Pages;

use App\Filament\Resources\FusionPBX\VoicemailGreetings\VoicemailGreetingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditVoicemailGreeting extends EditRecord
{
    protected static string $resource = VoicemailGreetingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
