<?php

namespace App\Filament\Resources\Astpp\CliGroupResource\Pages;

use App\Filament\Resources\Astpp\CliGroupResource\CliGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCliGroupRecords extends ListRecords
{
    protected static string $resource = CliGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
