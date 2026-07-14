<?php

namespace App\Filament\Resources\FusionPBX\ExtensionUsers\Pages;

use App\Filament\Resources\FusionPBX\ExtensionUsers\ExtensionUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateExtensionUser extends CreateRecord
{
    protected static string $resource = ExtensionUserResource::class;
}
