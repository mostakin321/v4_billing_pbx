<?php

namespace App\Filament\Resources\FusionPBX\FaxQueues\Pages;

use App\Filament\Resources\FusionPBX\FaxQueues\FaxQueueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFaxQueues extends ListRecords
{
    protected static string $resource = FaxQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
