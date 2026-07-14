<?php

namespace App\Filament\Resources\Astpp\OrderItemResource\Pages;

use App\Filament\Resources\Astpp\OrderItemResource\OrderItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOrderItem extends EditRecord
{
    protected static string $resource = OrderItemResource::class;

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }
}
