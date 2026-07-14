<?php

namespace App\Filament\Resources\Astpp\AddonResource\Pages;

use App\Filament\Resources\Astpp\AddonResource\AddonResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAddon extends EditRecord
{
    protected static string $resource = AddonResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
