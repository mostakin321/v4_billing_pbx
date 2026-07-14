<?php

namespace App\Filament\Resources\FusionPBX\MusicOnHolds\Pages;

use App\Filament\Resources\FusionPBX\MusicOnHolds\MusicOnHoldResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMusicOnHold extends EditRecord
{
    protected static string $resource = MusicOnHoldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
