<?php

namespace App\Filament\Resources\Astpp\RolePermissionResource\Pages;

use App\Filament\Resources\Astpp\RolePermissionResource\RolePermissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRolePermission extends EditRecord
{
    protected static string $resource = RolePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
