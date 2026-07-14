<?php

namespace App\Filament\Resources\FusionPBX\DialplanDetails\Pages;

use App\Filament\Resources\FusionPBX\DialplanDetails\DialplanDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDialplanDetail extends EditRecord
{
    protected static string $resource = DialplanDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
