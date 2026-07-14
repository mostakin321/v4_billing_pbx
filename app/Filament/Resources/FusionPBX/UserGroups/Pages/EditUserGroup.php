<?php

namespace App\Filament\Resources\FusionPBX\UserGroups\Pages;

use App\Filament\Resources\FusionPBX\UserGroups\UserGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserGroup extends EditRecord
{
    protected static string $resource = UserGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
