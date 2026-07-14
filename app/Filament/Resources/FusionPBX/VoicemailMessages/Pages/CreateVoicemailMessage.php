<?php

namespace App\Filament\Resources\FusionPBX\VoicemailMessages\Pages;

use App\Filament\Resources\FusionPBX\VoicemailMessages\VoicemailMessageResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoicemailMessage extends CreateRecord
{
    protected static string $resource = VoicemailMessageResource::class;
}
