<?php

namespace App\Filament\Resources\Astpp\AccountCalleridResource\Pages;

use App\Filament\Resources\Astpp\AccountCalleridResource\AccountCalleridResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAccountCalleridRecords extends ListRecords
{
    protected static string $resource = AccountCalleridResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
