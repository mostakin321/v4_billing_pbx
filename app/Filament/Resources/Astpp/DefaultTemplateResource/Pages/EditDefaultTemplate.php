<?php

namespace App\Filament\Resources\Astpp\DefaultTemplateResource\Pages;

use App\Filament\Resources\Astpp\DefaultTemplateResource\DefaultTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDefaultTemplate extends EditRecord
{
    protected static string $resource = DefaultTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
