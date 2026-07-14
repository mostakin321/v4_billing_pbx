<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslations\Pages;

use App\Filament\Resources\FusionPBX\NumberTranslations\NumberTranslationResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNumberTranslation extends EditRecord
{
    protected static string $resource = NumberTranslationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
