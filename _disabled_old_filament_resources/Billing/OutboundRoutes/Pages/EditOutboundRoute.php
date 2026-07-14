<?php
namespace App\Filament\Resources\Billing\OutboundRoutes\Pages;
use App\Filament\Resources\Billing\OutboundRoutes\OutboundRouteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
class EditOutboundRoute extends EditRecord {
    protected static string $resource = OutboundRouteResource::class;
    protected function getHeaderActions(): array { return [DeleteAction::make()]; }
}
