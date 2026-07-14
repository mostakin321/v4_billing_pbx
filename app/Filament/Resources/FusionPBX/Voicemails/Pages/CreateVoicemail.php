<?php

namespace App\Filament\Resources\FusionPBX\Voicemails\Pages;

use App\Filament\Resources\FusionPBX\Voicemails\VoicemailResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoicemail extends CreateRecord
{
    protected static string $resource = VoicemailResource::class;
}
