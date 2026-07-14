<?php

namespace App\Filament\Resources\Astpp\CurrencyResource\Pages;

use App\Filament\Resources\Astpp\CurrencyResource\CurrencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCurrencyRecords extends ListRecords
{
    protected static string $resource = CurrencyResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
