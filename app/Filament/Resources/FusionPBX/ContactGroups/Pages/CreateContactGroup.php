<?php

namespace App\Filament\Resources\FusionPBX\ContactGroups\Pages;

use App\Filament\Resources\FusionPBX\ContactGroups\ContactGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactGroup extends CreateRecord
{
    protected static string $resource = ContactGroupResource::class;
}
