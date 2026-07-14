<?php

namespace App\Filament\Resources\Astpp\PermissionResource\Pages;

use App\Filament\Resources\Astpp\PermissionResource\PermissionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPermissionRecords extends ListRecords
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
