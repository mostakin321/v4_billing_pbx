<?php

namespace App\Filament\Resources\FusionPBX\Modules\Pages;

use App\Filament\Resources\FusionPBX\Modules\ModuleResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditModule extends EditRecord
{
    protected static string $resource = ModuleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
