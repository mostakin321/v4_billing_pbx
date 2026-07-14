<?php

namespace App\Filament\Resources\Astpp\CategoryResource\Pages;

use App\Filament\Resources\Astpp\CategoryResource\CategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
