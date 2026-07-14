<?php

namespace App\Filament\Resources\FusionPBX\Dashboards\Pages;

use App\Filament\Resources\FusionPBX\Dashboards\DashboardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDashboard extends EditRecord
{
    protected static string $resource = DashboardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
