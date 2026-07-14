<?php

namespace App\Filament\Resources\Astpp\TranslationResource\Pages;

use App\Filament\Resources\Astpp\TranslationResource\TranslationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTranslation extends EditRecord
{
    protected static string $resource = TranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
