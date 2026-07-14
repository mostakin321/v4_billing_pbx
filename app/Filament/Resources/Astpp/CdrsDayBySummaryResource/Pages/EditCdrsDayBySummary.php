<?php

namespace App\Filament\Resources\Astpp\CdrsDayBySummaryResource\Pages;

use App\Filament\Resources\Astpp\CdrsDayBySummaryResource\CdrsDayBySummaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCdrsDayBySummary extends EditRecord
{
    protected static string $resource = CdrsDayBySummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
