<?php

namespace App\Filament\Resources\FusionPBX\ContactUsers\Pages;

use App\Filament\Resources\FusionPBX\ContactUsers\ContactUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactUser extends CreateRecord
{
    protected static string $resource = ContactUserResource::class;
}
