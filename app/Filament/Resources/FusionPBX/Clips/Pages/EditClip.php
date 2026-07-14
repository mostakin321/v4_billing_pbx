<?php

namespace App\Filament\Resources\FusionPBX\Clips\Pages;

use App\Filament\Resources\FusionPBX\Clips\ClipResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClip extends EditRecord
{
    protected static string $resource = ClipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
