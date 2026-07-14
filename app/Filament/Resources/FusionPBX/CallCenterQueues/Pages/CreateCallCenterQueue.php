<?php

namespace App\Filament\Resources\FusionPBX\CallCenterQueues\Pages;

use App\Filament\Resources\FusionPBX\CallCenterQueues\CallCenterQueueResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCallCenterQueue extends CreateRecord
{
    protected static string $resource = CallCenterQueueResource::class;
}
