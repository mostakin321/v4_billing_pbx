<?php

namespace App\Filament\Resources\FusionPBX\UserGroups\Pages;

use App\Filament\Resources\FusionPBX\UserGroups\UserGroupResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUserGroup extends CreateRecord
{
    protected static string $resource = UserGroupResource::class;
}
