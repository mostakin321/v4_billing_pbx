<?php
namespace App\Filament\Resources\Astpp\OutboundRouteResource\Pages;
use App\Filament\Resources\Astpp\OutboundRouteResource\OutboundRouteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOutboundRoute extends CreateRecord
{
    protected static string $resource = OutboundRouteResource::class;

    public function getTitle(): string { return 'Add Termination Rate'; }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
