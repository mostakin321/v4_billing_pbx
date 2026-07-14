<?php

namespace App\Filament\Resources\Astpp\AccountCalleridResource\Pages;

use App\Filament\Resources\Astpp\AccountCalleridResource\AccountCalleridResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountCallerid extends EditRecord
{
    protected static string $resource = AccountCalleridResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
