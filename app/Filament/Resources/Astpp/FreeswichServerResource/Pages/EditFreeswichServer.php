<?php

namespace App\Filament\Resources\Astpp\FreeswichServerResource\Pages;

use App\Filament\Resources\Astpp\FreeswichServerResource\FreeswichServerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFreeswichServer extends EditRecord
{
    protected static string $resource = FreeswichServerResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
