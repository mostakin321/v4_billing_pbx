<?php

namespace App\Filament\Resources\Astpp\LocalizationResource\Pages;

use App\Filament\Resources\Astpp\LocalizationResource\LocalizationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocalizationRecords extends ListRecords
{
    protected static string $resource = LocalizationResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
