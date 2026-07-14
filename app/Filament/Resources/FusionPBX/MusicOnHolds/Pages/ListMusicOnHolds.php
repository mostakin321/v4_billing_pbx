<?php

namespace App\Filament\Resources\FusionPBX\MusicOnHolds\Pages;

use App\Filament\Resources\FusionPBX\MusicOnHolds\MusicOnHoldResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMusicOnHolds extends ListRecords
{
    protected static string $resource = MusicOnHoldResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
