<?php

namespace App\Filament\Resources\FusionPBX\VoicemailGreetings\Pages;

use App\Filament\Resources\FusionPBX\VoicemailGreetings\VoicemailGreetingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVoicemailGreeting extends CreateRecord
{
    protected static string $resource = VoicemailGreetingResource::class;
}
