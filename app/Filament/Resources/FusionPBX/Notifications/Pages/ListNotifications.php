<?php

namespace App\Filament\Resources\FusionPBX\Notifications\Pages;

use App\Filament\Resources\FusionPBX\Notifications\NotificationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNotifications extends ListRecords
{
    protected static string $resource = NotificationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
