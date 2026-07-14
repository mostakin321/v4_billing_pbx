<?php

namespace App\Filament\Resources\Astpp\Q850CodeResource\Pages;

use App\Filament\Resources\Astpp\Q850CodeResource\Q850CodeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListQ850CodeRecords extends ListRecords
{
    protected static string $resource = Q850CodeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
