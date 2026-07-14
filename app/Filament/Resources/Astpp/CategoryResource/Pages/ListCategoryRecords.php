<?php

namespace App\Filament\Resources\Astpp\CategoryResource\Pages;

use App\Filament\Resources\Astpp\CategoryResource\CategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoryRecords extends ListRecords
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
