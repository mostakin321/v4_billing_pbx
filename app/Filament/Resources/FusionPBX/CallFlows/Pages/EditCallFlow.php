<?php

namespace App\Filament\Resources\FusionPBX\CallFlows\Pages;

use App\Filament\Resources\FusionPBX\CallFlows\CallFlowResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallFlow extends EditRecord
{
    protected static string $resource = CallFlowResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
