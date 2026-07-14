<?php

namespace App\Filament\Resources\FusionPBX\AccessControlNodes\Pages;

use App\Filament\Resources\FusionPBX\AccessControlNodes\AccessControlNodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessControlNodes extends ListRecords
{
    protected static string $resource = AccessControlNodeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
