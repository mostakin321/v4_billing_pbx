<?php
namespace App\Filament\Resources\Billing\OutboundRoutes\Pages;
use App\Filament\Resources\Billing\OutboundRoutes\OutboundRouteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
class ListOutboundRoutes extends ListRecords {
    protected static string $resource = OutboundRouteResource::class;
    protected function getHeaderActions(): array { return [CreateAction::make()]; }
}
