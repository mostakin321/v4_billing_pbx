<?php

namespace App\Filament\Resources\Astpp\MailDetailResource\Pages;

use App\Filament\Resources\Astpp\MailDetailResource\MailDetailResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMailDetailRecords extends ListRecords
{
    protected static string $resource = MailDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [CreateAction::make()];
    }
}
