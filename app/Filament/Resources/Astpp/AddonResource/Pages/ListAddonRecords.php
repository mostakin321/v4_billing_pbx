<?php

namespace App\Filament\Resources\Astpp\AddonResource\Pages;

use App\Filament\Resources\Astpp\AddonResource\AddonResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAddonRecords extends ListRecords
{
    protected static string $resource = AddonResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
