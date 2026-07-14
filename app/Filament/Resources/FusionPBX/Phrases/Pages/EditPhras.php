<?php

namespace App\Filament\Resources\FusionPBX\Phrases\Pages;

use App\Filament\Resources\FusionPBX\Phrases\PhrasResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPhras extends EditRecord
{
    protected static string $resource = PhrasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
