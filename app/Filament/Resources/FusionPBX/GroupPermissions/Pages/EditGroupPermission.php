<?php

namespace App\Filament\Resources\FusionPBX\GroupPermissions\Pages;

use App\Filament\Resources\FusionPBX\GroupPermissions\GroupPermissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGroupPermission extends EditRecord
{
    protected static string $resource = GroupPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
