<?php

namespace App\Filament\Resources\FusionPBX\CallCenterAgents\Pages;

use App\Filament\Resources\FusionPBX\CallCenterAgents\CallCenterAgentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallCenterAgent extends EditRecord
{
    protected static string $resource = CallCenterAgentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
