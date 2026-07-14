<?php

namespace App\Filament\Resources\Astpp\AccessnumberResource\Pages;

use App\Filament\Resources\Astpp\AccessnumberResource\AccessnumberResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccessnumber extends EditRecord
{
    protected static string $resource = AccessnumberResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
