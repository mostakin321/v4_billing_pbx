<?php

namespace App\Filament\Resources\Astpp\RouteResource\Pages;

use App\Filament\Resources\Astpp\RouteResource\RouteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRoute extends EditRecord
{
    protected static string $resource = RouteResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
