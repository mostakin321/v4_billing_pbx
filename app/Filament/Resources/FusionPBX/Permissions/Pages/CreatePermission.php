<?php

namespace App\Filament\Resources\FusionPBX\Permissions\Pages;

use App\Filament\Resources\FusionPBX\Permissions\PermissionResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
}
