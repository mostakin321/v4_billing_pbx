<?php

namespace App\Filament\Resources\FusionPBX\ConferenceUsers\Pages;

use App\Filament\Resources\FusionPBX\ConferenceUsers\ConferenceUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateConferenceUser extends CreateRecord
{
    protected static string $resource = ConferenceUserResource::class;
}
