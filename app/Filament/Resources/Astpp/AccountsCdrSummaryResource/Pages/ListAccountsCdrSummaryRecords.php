<?php

namespace App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Pages;

use App\Filament\Resources\Astpp\AccountsCdrSummaryResource\AccountsCdrSummaryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountsCdrSummaryRecords extends ListRecords
{
    protected static string $resource = AccountsCdrSummaryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
