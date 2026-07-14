<?php

namespace App\Filament\Resources\Astpp\ResellerProductResource\Pages;

use App\Filament\Resources\Astpp\ResellerProductResource\ResellerProductResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResellerProductRecords extends ListRecords
{
    protected static string $resource = ResellerProductResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
