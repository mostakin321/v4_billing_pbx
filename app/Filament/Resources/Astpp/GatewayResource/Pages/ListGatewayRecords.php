<?php

namespace App\Filament\Resources\Astpp\GatewayResource\Pages;

use App\Filament\Resources\Astpp\GatewayResource\GatewayResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGatewayRecords extends ListRecords
{
    protected static string $resource = GatewayResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
