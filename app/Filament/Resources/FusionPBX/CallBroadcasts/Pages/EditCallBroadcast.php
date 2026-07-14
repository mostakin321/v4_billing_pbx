<?php

namespace App\Filament\Resources\FusionPBX\CallBroadcasts\Pages;

use App\Filament\Resources\FusionPBX\CallBroadcasts\CallBroadcastResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCallBroadcast extends EditRecord
{
    protected static string $resource = CallBroadcastResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
