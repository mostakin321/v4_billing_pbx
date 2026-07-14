<?php

namespace App\Filament\Resources\Astpp\OrderResource\Pages;

use App\Filament\Resources\Astpp\OrderResource\OrderResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListOrderRecords extends ListRecords
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
