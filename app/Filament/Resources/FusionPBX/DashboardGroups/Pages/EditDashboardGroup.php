<?php

namespace App\Filament\Resources\FusionPBX\DashboardGroups\Pages;

use App\Filament\Resources\FusionPBX\DashboardGroups\DashboardGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDashboardGroup extends EditRecord
{
    protected static string $resource = DashboardGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
