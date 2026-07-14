<?php

namespace App\Filament\Resources\Astpp\ResellerCdrResource\Pages;

use App\Filament\Resources\Astpp\ResellerCdrResource\ResellerCdrResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResellerCdr extends EditRecord
{
    protected static string $resource = ResellerCdrResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
