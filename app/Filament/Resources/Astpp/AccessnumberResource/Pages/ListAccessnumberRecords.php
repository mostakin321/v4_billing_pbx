<?php

namespace App\Filament\Resources\Astpp\AccessnumberResource\Pages;

use App\Filament\Resources\Astpp\AccessnumberResource\AccessnumberResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccessnumberRecords extends ListRecords
{
    protected static string $resource = AccessnumberResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
