<?php

namespace App\Filament\Resources\FusionPBX\VoicemailOptions\Pages;

use App\Filament\Resources\FusionPBX\VoicemailOptions\VoicemailOptionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoicemailOption extends CreateRecord
{
    protected static string $resource = VoicemailOptionResource::class;
}
