<?php

namespace App\Filament\Resources\Astpp\RoutingResource\Pages;

use App\Filament\Resources\Astpp\RoutingResource\RoutingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRoutingRecords extends ListRecords
{
    protected static string $resource = RoutingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
