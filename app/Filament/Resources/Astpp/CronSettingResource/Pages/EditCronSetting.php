<?php

namespace App\Filament\Resources\Astpp\CronSettingResource\Pages;

use App\Filament\Resources\Astpp\CronSettingResource\CronSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCronSetting extends EditRecord
{
    protected static string $resource = CronSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
