<?php

namespace App\Filament\Resources\FusionPBX\CallCenterAgents\Pages;

use App\Filament\Resources\FusionPBX\CallCenterAgents\CallCenterAgentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCallCenterAgent extends CreateRecord
{
    protected static string $resource = CallCenterAgentResource::class;
}
