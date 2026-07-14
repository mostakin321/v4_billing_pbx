<?php

namespace App\Filament\Resources\Astpp\CalltypeResource\Pages;

use App\Filament\Resources\Astpp\CalltypeResource\CalltypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCalltypeRecords extends ListRecords
{
    protected static string $resource = CalltypeResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
