<?php

namespace App\Filament\Resources\Astpp\DidResource\Pages;

use App\Filament\Resources\Astpp\DidResource\DidResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDidRecords extends ListRecords
{
    protected static string $resource = DidResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
