<?php

namespace App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Pages;

use App\Filament\Resources\Astpp\ProviderCdrSummaryResource\ProviderCdrSummaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProviderCdrSummaryRecords extends ListRecords
{
    protected static string $resource = ProviderCdrSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
