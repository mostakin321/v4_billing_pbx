<?php

namespace App\Filament\Resources\Astpp\AccountUnverifiedResource\Pages;

use App\Filament\Resources\Astpp\AccountUnverifiedResource\AccountUnverifiedResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAccountUnverified extends EditRecord
{
    protected static string $resource = AccountUnverifiedResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
