<?php

namespace App\Filament\Resources\FusionPBX\Streams\Pages;

use App\Filament\Resources\FusionPBX\Streams\StreamResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStream extends EditRecord
{
    protected static string $resource = StreamResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
