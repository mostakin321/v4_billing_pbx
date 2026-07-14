<?php

namespace App\Filament\Resources\Astpp\OutboundRouteResource\Pages;

use App\Filament\Resources\Astpp\OutboundRouteResource\OutboundRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOutboundRouteRecords extends ListRecords
{
    protected static string $resource = OutboundRouteResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
