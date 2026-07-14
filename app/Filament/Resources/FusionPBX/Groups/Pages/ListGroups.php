<?php

namespace App\Filament\Resources\FusionPBX\Groups\Pages;

use App\Filament\Resources\FusionPBX\Groups\GroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGroups extends ListRecords
{
    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
