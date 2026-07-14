<?php

namespace App\Filament\Resources\Astpp\CdrsStagingResource\Pages;

use App\Filament\Resources\Astpp\CdrsStagingResource\CdrsStagingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCdrsStaging extends EditRecord
{
    protected static string $resource = CdrsStagingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
