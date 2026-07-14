<?php

namespace App\Filament\Resources\FusionPBX\DashboardGroups\Pages;

use App\Filament\Resources\FusionPBX\DashboardGroups\DashboardGroupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDashboardGroups extends ListRecords
{
    protected static string $resource = DashboardGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
