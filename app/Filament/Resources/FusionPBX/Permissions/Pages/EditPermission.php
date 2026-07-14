<?php

namespace App\Filament\Resources\FusionPBX\Permissions\Pages;

use App\Filament\Resources\FusionPBX\Permissions\PermissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
