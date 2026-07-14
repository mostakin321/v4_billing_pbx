<?php

namespace App\Filament\Resources\FusionPBX\Contacts\Pages;

use App\Filament\Resources\FusionPBX\Contacts\ContactResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContact extends CreateRecord
{
    protected static string $resource = ContactResource::class;
}
