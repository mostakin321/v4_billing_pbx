<?php

namespace App\Filament\Resources\Astpp\CommissionResource\Pages;

use App\Filament\Resources\Astpp\CommissionResource\CommissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCommission extends EditRecord
{
    protected static string $resource = CommissionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
