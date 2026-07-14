<?php

namespace App\Filament\Resources\FusionPBX\UserLogs\Pages;

use App\Filament\Resources\FusionPBX\UserLogs\UserLogResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserLog extends CreateRecord
{
    protected static string $resource = UserLogResource::class;
}
