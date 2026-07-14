<?php

namespace App\Filament\Resources\Astpp\CronSettingResource\Pages;

use App\Filament\Resources\Astpp\CronSettingResource\CronSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCronSettingRecords extends ListRecords
{
    protected static string $resource = CronSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
