<?php

namespace App\Filament\Resources\Astpp\SystemSettingResource\Pages;

use App\Filament\Resources\Astpp\SystemSettingResource\SystemSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSystemSettingRecords extends ListRecords
{
    protected static string $resource = SystemSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
