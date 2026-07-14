<?php

namespace App\Filament\Resources\Astpp\DefaultTemplateResource\Pages;

use App\Filament\Resources\Astpp\DefaultTemplateResource\DefaultTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDefaultTemplateRecords extends ListRecords
{
    protected static string $resource = DefaultTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
