<?php

namespace App\Filament\Resources\Astpp\CdrResource\Pages;

use App\Filament\Resources\Astpp\CdrResource\CdrResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCdrRecords extends ListRecords
{
    protected static string $resource = CdrResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
