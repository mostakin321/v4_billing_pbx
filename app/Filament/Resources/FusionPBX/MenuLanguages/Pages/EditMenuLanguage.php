<?php

namespace App\Filament\Resources\FusionPBX\MenuLanguages\Pages;

use App\Filament\Resources\FusionPBX\MenuLanguages\MenuLanguageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMenuLanguage extends EditRecord
{
    protected static string $resource = MenuLanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
