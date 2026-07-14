<?php

namespace App\Filament\Resources\FusionPBX\Fifos\Pages;

use App\Filament\Resources\FusionPBX\Fifos\FifoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFifo extends EditRecord
{
    protected static string $resource = FifoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
