<?php

namespace App\Filament\Resources\Astpp\CommissionResource\Pages;

use App\Filament\Resources\Astpp\CommissionResource\CommissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCommissionRecords extends ListRecords
{
    protected static string $resource = CommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
