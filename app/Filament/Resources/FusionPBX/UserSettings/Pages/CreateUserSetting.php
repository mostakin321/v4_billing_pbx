<?php

namespace App\Filament\Resources\FusionPBX\UserSettings\Pages;

use App\Filament\Resources\FusionPBX\UserSettings\UserSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserSetting extends CreateRecord
{
    protected static string $resource = UserSettingResource::class;
}
