<?php

namespace App\Filament\Resources\FusionPBX\UserLogs\Pages;

use App\Filament\Resources\FusionPBX\UserLogs\UserLogResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListUserLogs extends ListRecords
{
    protected static string $resource = UserLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
