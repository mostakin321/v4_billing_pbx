<?php

namespace App\Filament\Resources\Astpp\LanguageResource\Pages;

use App\Filament\Resources\Astpp\LanguageResource\LanguageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLanguage extends EditRecord
{
    protected static string $resource = LanguageResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
