<?php

namespace App\Filament\Resources\Astpp\SweeplistResource\Pages;

use App\Filament\Resources\Astpp\SweeplistResource\SweeplistResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSweeplist extends EditRecord
{
    protected static string $resource = SweeplistResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
