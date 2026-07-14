<?php

namespace App\Filament\Resources\Astpp\AccountResource\Pages;

use App\Filament\Resources\Astpp\AccountResource\AccountResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountRecords extends ListRecords
{
    protected static string $resource = AccountResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
