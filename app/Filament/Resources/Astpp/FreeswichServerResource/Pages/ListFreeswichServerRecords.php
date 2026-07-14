<?php

namespace App\Filament\Resources\Astpp\FreeswichServerResource\Pages;

use App\Filament\Resources\Astpp\FreeswichServerResource\FreeswichServerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFreeswichServerRecords extends ListRecords
{
    protected static string $resource = FreeswichServerResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
