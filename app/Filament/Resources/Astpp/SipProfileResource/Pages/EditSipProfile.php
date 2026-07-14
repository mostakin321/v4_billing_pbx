<?php

namespace App\Filament\Resources\Astpp\SipProfileResource\Pages;

use App\Filament\Resources\Astpp\SipProfileResource\SipProfileResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSipProfile extends EditRecord
{
    protected static string $resource = SipProfileResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
