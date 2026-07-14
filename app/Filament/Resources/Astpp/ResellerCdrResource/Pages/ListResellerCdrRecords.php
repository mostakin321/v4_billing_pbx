<?php

namespace App\Filament\Resources\Astpp\ResellerCdrResource\Pages;

use App\Filament\Resources\Astpp\ResellerCdrResource\ResellerCdrResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResellerCdrRecords extends ListRecords
{
    protected static string $resource = ResellerCdrResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
