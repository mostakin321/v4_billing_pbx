<?php

namespace App\Filament\Resources\Astpp\UsertrackingResource\Pages;

use App\Filament\Resources\Astpp\UsertrackingResource\UsertrackingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUsertracking extends EditRecord
{
    protected static string $resource = UsertrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
