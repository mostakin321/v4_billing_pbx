<?php

namespace App\Filament\Resources\Astpp\CliGroupResource\Pages;

use App\Filament\Resources\Astpp\CliGroupResource\CliGroupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCliGroup extends EditRecord
{
    protected static string $resource = CliGroupResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
