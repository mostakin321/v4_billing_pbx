<?php

namespace App\Filament\Resources\Astpp\RatedeckResource\Pages;

use App\Filament\Resources\Astpp\RatedeckResource\RatedeckResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRatedeckRecords extends ListRecords
{
    protected static string $resource = RatedeckResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
