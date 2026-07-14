<?php

namespace App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Pages;

use App\Filament\Resources\Astpp\AccountsCdrSummaryResource\AccountsCdrSummaryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountsCdrSummary extends EditRecord
{
    protected static string $resource = AccountsCdrSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
