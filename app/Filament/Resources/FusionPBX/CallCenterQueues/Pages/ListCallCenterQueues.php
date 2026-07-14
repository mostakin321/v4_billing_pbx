<?php

namespace App\Filament\Resources\FusionPBX\CallCenterQueues\Pages;

use App\Filament\Resources\FusionPBX\CallCenterQueues\CallCenterQueueResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallCenterQueues extends ListRecords
{
    protected static string $resource = CallCenterQueueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
