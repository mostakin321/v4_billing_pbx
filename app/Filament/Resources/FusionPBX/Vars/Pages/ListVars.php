<?php

namespace App\Filament\Resources\FusionPBX\Vars\Pages;

use App\Filament\Resources\FusionPBX\Vars\VarResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVars extends ListRecords
{
    protected static string $resource = VarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
