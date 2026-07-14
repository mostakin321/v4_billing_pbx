<?php

namespace App\Filament\Resources\Astpp\RolePermissionResource\Pages;

use App\Filament\Resources\Astpp\RolePermissionResource\RolePermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRolePermissionRecords extends ListRecords
{
    protected static string $resource = RolePermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
