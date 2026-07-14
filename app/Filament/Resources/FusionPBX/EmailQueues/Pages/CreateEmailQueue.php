<?php

namespace App\Filament\Resources\FusionPBX\EmailQueues\Pages;

use App\Filament\Resources\FusionPBX\EmailQueues\EmailQueueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateEmailQueue extends CreateRecord
{
    protected static string $resource = EmailQueueResource::class;
}
