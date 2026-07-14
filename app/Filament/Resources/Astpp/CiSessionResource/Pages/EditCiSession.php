<?php

namespace App\Filament\Resources\Astpp\CiSessionResource\Pages;

use App\Filament\Resources\Astpp\CiSessionResource\CiSessionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCiSession extends EditRecord
{
    protected static string $resource = CiSessionResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
