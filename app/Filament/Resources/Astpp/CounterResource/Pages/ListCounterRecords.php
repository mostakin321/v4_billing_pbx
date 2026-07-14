<?php

namespace App\Filament\Resources\Astpp\CounterResource\Pages;

use App\Filament\Resources\Astpp\CounterResource\CounterResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCounterRecords extends ListRecords
{
    protected static string $resource = CounterResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
