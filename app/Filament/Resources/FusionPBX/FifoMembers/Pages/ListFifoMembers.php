<?php

namespace App\Filament\Resources\FusionPBX\FifoMembers\Pages;

use App\Filament\Resources\FusionPBX\FifoMembers\FifoMemberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFifoMembers extends ListRecords
{
    protected static string $resource = FifoMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
