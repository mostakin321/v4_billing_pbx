<?php

namespace App\Filament\Resources\FusionPBX\AccessControls\Pages;

use App\Filament\Resources\FusionPBX\AccessControls\AccessControlResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessControl extends EditRecord
{
    protected static string $resource = AccessControlResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
