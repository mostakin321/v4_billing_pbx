<?php

namespace App\Filament\Resources\FusionPBX\FaxUsers\Pages;

use App\Filament\Resources\FusionPBX\FaxUsers\FaxUserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFaxUser extends CreateRecord
{
    protected static string $resource = FaxUserResource::class;
}
