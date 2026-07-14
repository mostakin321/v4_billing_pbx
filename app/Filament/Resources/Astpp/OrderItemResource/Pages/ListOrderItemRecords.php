<?php

namespace App\Filament\Resources\Astpp\OrderItemResource\Pages;

use App\Filament\Resources\Astpp\OrderItemResource\OrderItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrderItemRecords extends ListRecords
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
