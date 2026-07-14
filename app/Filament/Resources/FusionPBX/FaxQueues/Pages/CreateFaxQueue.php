<?php

namespace App\Filament\Resources\FusionPBX\FaxQueues\Pages;

use App\Filament\Resources\FusionPBX\FaxQueues\FaxQueueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFaxQueue extends CreateRecord
{
    protected static string $resource = FaxQueueResource::class;
}
