<?php

namespace App\Filament\Resources\FusionPBX\Languages\Pages;

use App\Filament\Resources\FusionPBX\Languages\LanguageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLanguage extends EditRecord
{
    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
