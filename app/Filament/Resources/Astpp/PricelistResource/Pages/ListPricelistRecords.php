<?php

namespace App\Filament\Resources\Astpp\PricelistResource\Pages;

use App\Filament\Resources\Astpp\PricelistResource\PricelistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPricelistRecords extends ListRecords
{
    protected static string $resource = PricelistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
