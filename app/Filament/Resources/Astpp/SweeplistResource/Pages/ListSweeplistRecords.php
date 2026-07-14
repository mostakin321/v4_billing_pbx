<?php

namespace App\Filament\Resources\Astpp\SweeplistResource\Pages;

use App\Filament\Resources\Astpp\SweeplistResource\SweeplistResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSweeplistRecords extends ListRecords
{
    protected static string $resource = SweeplistResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
