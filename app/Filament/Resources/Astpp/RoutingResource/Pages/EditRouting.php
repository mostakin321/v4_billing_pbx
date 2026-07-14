<?php

namespace App\Filament\Resources\Astpp\RoutingResource\Pages;

use App\Filament\Resources\Astpp\RoutingResource\RoutingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRouting extends EditRecord
{
    protected static string $resource = RoutingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
