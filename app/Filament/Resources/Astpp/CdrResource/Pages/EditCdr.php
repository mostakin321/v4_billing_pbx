<?php

namespace App\Filament\Resources\Astpp\CdrResource\Pages;

use App\Filament\Resources\Astpp\CdrResource\CdrResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCdr extends EditRecord
{
    protected static string $resource = CdrResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
