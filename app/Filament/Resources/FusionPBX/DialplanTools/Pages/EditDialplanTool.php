<?php

namespace App\Filament\Resources\FusionPBX\DialplanTools\Pages;

use App\Filament\Resources\FusionPBX\DialplanTools\DialplanToolResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDialplanTool extends EditRecord
{
    protected static string $resource = DialplanToolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
