<?php

namespace App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Pages;

use App\Filament\Resources\Astpp\CdrsDayBySummaryResource\CdrsDayBySummaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCdrsDayBySummaryRecords extends ListRecords
{
    protected static string $resource = CdrsDayBySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
