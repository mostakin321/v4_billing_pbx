<?php

namespace App\Filament\Resources\FusionPBX\UserGroups\Pages;

use App\Filament\Resources\FusionPBX\UserGroups\UserGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserGroups extends ListRecords
{
    protected static string $resource = UserGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
