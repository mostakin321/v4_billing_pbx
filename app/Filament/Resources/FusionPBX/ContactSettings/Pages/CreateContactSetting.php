<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings\Pages;

use App\Filament\Resources\FusionPBX\ContactSettings\ContactSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateContactSetting extends CreateRecord
{
    protected static string $resource = ContactSettingResource::class;
}
