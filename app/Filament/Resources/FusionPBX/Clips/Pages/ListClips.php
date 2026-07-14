<?php

namespace App\Filament\Resources\FusionPBX\Clips\Pages;

use App\Filament\Resources\FusionPBX\Clips\ClipResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClips extends ListRecords
{
    protected static string $resource = ClipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
