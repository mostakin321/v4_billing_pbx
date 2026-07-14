<?php

namespace App\Filament\Resources\Astpp\RouteResource\Pages;

use App\Filament\Resources\Astpp\RouteResource\RouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRouteRecords extends ListRecords
{
    protected static string $resource = RouteResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
