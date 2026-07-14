<?php

namespace App\Filament\Resources\Astpp\CdrsStagingResource\Pages;

use App\Filament\Resources\Astpp\CdrsStagingResource\CdrsStagingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCdrsStagingRecords extends ListRecords
{
    protected static string $resource = CdrsStagingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
