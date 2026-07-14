<?php

namespace App\Filament\Resources\FusionPBX\UserLogs\Pages;

use App\Filament\Resources\FusionPBX\UserLogs\UserLogResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUserLog extends EditRecord
{
    protected static string $resource = UserLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
