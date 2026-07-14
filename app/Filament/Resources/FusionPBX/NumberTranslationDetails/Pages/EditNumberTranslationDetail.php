<?php

namespace App\Filament\Resources\FusionPBX\NumberTranslationDetails\Pages;

use App\Filament\Resources\FusionPBX\NumberTranslationDetails\NumberTranslationDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNumberTranslationDetail extends EditRecord
{
    protected static string $resource = NumberTranslationDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
