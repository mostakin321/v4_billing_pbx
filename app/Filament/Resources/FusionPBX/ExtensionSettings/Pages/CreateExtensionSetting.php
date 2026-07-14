<?php

namespace App\Filament\Resources\FusionPBX\ExtensionSettings\Pages;

use App\Filament\Resources\FusionPBX\ExtensionSettings\ExtensionSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExtensionSetting extends CreateRecord
{
    protected static string $resource = ExtensionSettingResource::class;
}
