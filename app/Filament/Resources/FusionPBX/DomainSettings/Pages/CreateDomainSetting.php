<?php

namespace App\Filament\Resources\FusionPBX\DomainSettings\Pages;

use App\Filament\Resources\FusionPBX\DomainSettings\DomainSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDomainSetting extends CreateRecord
{
    protected static string $resource = DomainSettingResource::class;
}
