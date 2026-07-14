<?php

namespace App\Filament\Resources\FusionPBX\Dialplans\Pages;

use App\Filament\Resources\FusionPBX\Dialplans\DialplanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDialplan extends EditRecord
{
    protected static string $resource = DialplanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
