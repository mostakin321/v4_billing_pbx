<?php

namespace App\Filament\Resources\FusionPBX\CallBlocks\Pages;

use App\Filament\Resources\FusionPBX\CallBlocks\CallBlockResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCallBlocks extends ListRecords
{
    protected static string $resource = CallBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
