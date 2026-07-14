<?php

namespace App\Filament\Resources\Astpp\SpeedDialResource\Pages;

use App\Filament\Resources\Astpp\SpeedDialResource\SpeedDialResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpeedDialRecords extends ListRecords
{
    protected static string $resource = SpeedDialResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
