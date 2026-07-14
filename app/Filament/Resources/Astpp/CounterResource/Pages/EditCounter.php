<?php

namespace App\Filament\Resources\Astpp\CounterResource\Pages;

use App\Filament\Resources\Astpp\CounterResource\CounterResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCounter extends EditRecord
{
    protected static string $resource = CounterResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
