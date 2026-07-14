<?php

namespace App\Filament\Resources\Astpp\ProviderCdrSummaryResource\Pages;

use App\Filament\Resources\Astpp\ProviderCdrSummaryResource\ProviderCdrSummaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProviderCdrSummary extends EditRecord
{
    protected static string $resource = ProviderCdrSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
