<?php
namespace App\Filament\Resources\Astpp\OutboundRouteResource\Pages;
use App\Filament\Resources\Astpp\OutboundRouteResource\OutboundRouteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOutboundRoute extends EditRecord
{
    protected static string $resource = OutboundRouteResource::class;

    public function getTitle(): string { return 'Edit Termination Rate'; }

    protected function getHeaderActions(): array
    {
        return [DeleteAction::make()];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
