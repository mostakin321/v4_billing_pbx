<?php

namespace App\Filament\Resources\FusionPBX\AccessControlNodes\Pages;

use App\Filament\Resources\FusionPBX\AccessControlNodes\AccessControlNodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessControlNode extends EditRecord
{
    protected static string $resource = AccessControlNodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
