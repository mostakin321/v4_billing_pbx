<?php

namespace App\Filament\Resources\FusionPBX\EmailQueues\Pages;

use App\Filament\Resources\FusionPBX\EmailQueues\EmailQueueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEmailQueues extends ListRecords
{
    protected static string $resource = EmailQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
