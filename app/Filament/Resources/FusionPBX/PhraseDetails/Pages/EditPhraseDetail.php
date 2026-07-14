<?php

namespace App\Filament\Resources\FusionPBX\PhraseDetails\Pages;

use App\Filament\Resources\FusionPBX\PhraseDetails\PhraseDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPhraseDetail extends EditRecord
{
    protected static string $resource = PhraseDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
