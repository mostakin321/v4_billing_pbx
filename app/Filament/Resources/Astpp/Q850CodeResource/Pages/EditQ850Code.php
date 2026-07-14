<?php

namespace App\Filament\Resources\Astpp\Q850CodeResource\Pages;

use App\Filament\Resources\Astpp\Q850CodeResource\Q850CodeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditQ850Code extends EditRecord
{
    protected static string $resource = Q850CodeResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
