<?php

namespace App\Filament\Resources\Astpp\LanguageResource\Pages;

use App\Filament\Resources\Astpp\LanguageResource\LanguageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLanguageRecords extends ListRecords
{
    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
