<?php

namespace App\Filament\Resources\Astpp\CiSessionResource\Pages;

use App\Filament\Resources\Astpp\CiSessionResource\CiSessionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCiSessionRecords extends ListRecords
{
    protected static string $resource = CiSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
