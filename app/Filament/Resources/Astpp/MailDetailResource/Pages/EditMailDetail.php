<?php

namespace App\Filament\Resources\Astpp\MailDetailResource\Pages;

use App\Filament\Resources\Astpp\MailDetailResource\MailDetailResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMailDetail extends EditRecord
{
    protected static string $resource = MailDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
