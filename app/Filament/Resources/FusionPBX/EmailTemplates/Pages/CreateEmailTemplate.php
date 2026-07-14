<?php

namespace App\Filament\Resources\FusionPBX\EmailTemplates\Pages;

use App\Filament\Resources\FusionPBX\EmailTemplates\EmailTemplateResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailTemplate extends CreateRecord
{
    protected static string $resource = EmailTemplateResource::class;
}
