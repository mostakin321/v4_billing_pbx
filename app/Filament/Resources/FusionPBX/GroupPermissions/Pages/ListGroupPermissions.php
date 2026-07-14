<?php

namespace App\Filament\Resources\FusionPBX\GroupPermissions\Pages;

use App\Filament\Resources\FusionPBX\GroupPermissions\GroupPermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroupPermissions extends ListRecords
{
    protected static string $resource = GroupPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
