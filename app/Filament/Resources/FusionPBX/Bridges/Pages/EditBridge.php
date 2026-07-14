<?php

namespace App\Filament\Resources\FusionPBX\Bridges\Pages;

use App\Filament\Resources\FusionPBX\Bridges\BridgeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBridge extends EditRecord
{
    protected static string $resource = BridgeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
