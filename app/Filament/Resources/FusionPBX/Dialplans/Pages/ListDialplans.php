<?php

namespace App\Filament\Resources\FusionPBX\Dialplans\Pages;

use App\Filament\Resources\FusionPBX\Dialplans\DialplanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDialplans extends ListRecords
{
    protected static string $resource = DialplanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
