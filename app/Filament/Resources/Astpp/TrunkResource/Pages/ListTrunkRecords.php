<?php

namespace App\Filament\Resources\Astpp\TrunkResource\Pages;

use App\Filament\Resources\Astpp\TrunkResource\TrunkResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrunkRecords extends ListRecords
{
    protected static string $resource = TrunkResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
