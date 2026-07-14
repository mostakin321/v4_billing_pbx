<?php

namespace App\Filament\Resources\Astpp\SystemSettingResource\Pages;

use App\Filament\Resources\Astpp\SystemSettingResource\SystemSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSystemSetting extends EditRecord
{
    protected static string $resource = SystemSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
